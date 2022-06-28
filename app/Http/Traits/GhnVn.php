<?php

namespace App\Http\Traits;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\ShippingPaymentType;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\map;

trait GhnVn
{

    public function getServicesGhn(int $fromDistrict, int $toDistrict)
    {
        // dd(config('app.shop_id_ghn'), $fromDistrict , $toDistrict);
        try {
            $reponse = Http::withHeaders([
                'token' => config('app.token_ghn'),
                'Content-Type' => 'application/json',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', [
                "from_district" => $fromDistrict,
                "to_district" => $toDistrict,
                "shop_id" => (int) config('app.shop_id_ghn'),
            ])->json();
            if ($reponse['code'] === 200) {
                // just get express and standard shipping
                return [
                    'services' => array_filter($reponse['data'], fn ($service) => in_array($service['service_type_id'], [1, 3])),
                    'message' =>  $reponse['code_message_value'],
                ];
            }
        } catch (Exception $th) {
            dd($th);
        }
    }

    public function calculateFeeGhn(array $shipmentInfo)
    {
        $fee = Http::withHeaders([
            'token' => config('app.token_ghn'),
            "shop_id" => config('app.shop_id_ghn'),
            'Content-Type' => 'application/json',
        ])
            ->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $shipmentInfo)
            ->json();
        return $fee['data']['total'];
    }

    public function getProvinces()
    {
        return Cache::remember('provinces', 60 * 60 * 24, function () {
            $provinces = Http::withHeaders([
                'token' => config('app.token_ghn'),
                'Content-Type' => 'application/json',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province')->json()['data'];

            return array_map(fn ($province) => (object) [
                'description' => $province['ProvinceName'],
                'value' => json_encode([
                    'provinceId' => $province['ProvinceID'],
                    'provinceName' =>  $province['ProvinceName'],
                ]),
                'nameExtension' => implode(" ", array_key_exists('NameExtension', $province) ? $province['NameExtension'] : [$province['ProvinceName']]),
            ], $provinces);
        });
    }

    public function getDistricts(int $provinceId)
    {
        return Cache::remember('districts?province_id=' . $provinceId, 60 * 60 * 24, function () use ($provinceId) {
            $districts =  Http::withHeaders([
                'token' => config('app.token_ghn'),
                'Content-Type' => 'application/json',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=' . $provinceId)->json()['data'];
            return array_map(fn ($district) => (object) [
                'description' => $district['DistrictName'],
                'value' => json_encode([
                    'districtId' => $district['DistrictID'],
                    'districtName' => $district['DistrictName'],
                ]),
                'nameExtension' => implode(" ", array_key_exists('NameExtension', $district) ? $district['NameExtension'] : [$district['DistrictName']]),
            ], $districts);
        });
    }

    public function getWards(int $districtId)
    {
        return Cache::remember('wards?district_id=' . $districtId, 60 * 60 * 24, function () use ($districtId) {
            $wards =  Http::withHeaders([
                'token' => config('app.token_ghn'),
                'Content-Type' => 'application/json',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=' . $districtId)->json()['data'];
            return array_map(fn ($ward) => (object) [
                'description' => $ward['WardName'],
                'value' => json_encode([
                    'wardCode' => $ward['WardCode'],
                    'wardName' => $ward['WardName'],
                ]),
                'nameExtension' => implode(" ",  array_key_exists('NameExtension', $ward) ? $ward['NameExtension'] : [$ward['WardName']]),
            ], $wards);
        });
    }

    public function createOrderGhn(Order $order)
    {
        if ($order->status !== OrderStatus::PENDING) {
            throw  new Exception('Create order ghn exception');
        }
        $previewUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/preview';
        $createUrl = 'https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create';

        $data = [
            "payment_type_id" => $order->shipping_payment_type === ShippingPaymentType::SHOP_PAY ? 1 : 2,
            "note" => "Tintest 123",
            "required_note" => "KHONGCHOXEMHANG",
            "return_phone" => $order->storeBranch->phone,
            "return_address" => $order->storeBranch->address,
            "return_district_id" => $order->storeBranch->district_id,
            "return_ward_code" => $order->storeBranch->ward_code,
            "client_order_code" => (string) $order->id,
            "to_name" => $order->recipient_name,
            "to_phone" => $order->recipient_phone,
            "to_address" => $order->shipping_address,
            "to_ward_code" => $order->ward_code,
            "to_district_id" => $order->district_id,
            "cod_amount" =>  $order->payment_status !== PaymentStatus::SUNCCESS ? 0 : ((int)(string) $order->amount->getAmount()),
            "content" => "Order from store " . $order->storeBranch->name . "on the Emarket",
            "weight" => collect($order->orderItems)->sum(fn ($orderItem) => $orderItem->sku->weight),
            "width" => 19,
            "service_id" => 0,
            "service_type_id" => $order->service_type_id_ghn,
            "coupon" => null,
            "pick_shift" => [2],
            "items" => collect($order->orderItems)->map(fn ($orderItem) => [
                "name" => $orderItem->product_name,
                "code" => $orderItem->sku->barcode,
                "quantity" => $orderItem->qty,
                "price" => (int)(string) $orderItem->price->getAmount(),
            ])->all(),
        ];

        $reponse = Http::withHeaders([
            'Token' => config('app.token_ghn'),
            'ShopId' => $order->storeBranch->shop_id,
        ])->post($createUrl, $data)
            ->json();
        if ($reponse['code'] === 200) {
            $order->shipping_fee = $reponse['data']['total_fee'];
            $order->order_code_ghn = $reponse['data']['order_code'];
            return true;
        }

        return false;
    }

    public function genPrintOrderTokenGhn(Order $order)
    {
        try {
            $response =  Http::withHeaders([
                'token' => config('app.token_ghn'),
                'Content-Type' => 'application/json',
            ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/a5/gen-token', ['order_codes' => [$order->order_code_ghn]])
            ->json();
            if($response['code'] === 200){
                return $response['data']['token'];
            }
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
