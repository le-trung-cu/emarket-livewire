<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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
        ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $shipmentInfo);

        $fee =    $fee->json()['data']['total'];

        return $fee;
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
}
