<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait GhnVn
{

    public function getServicesGhn(int $fromDistrict, int $toDistrict)
    {
        $services = Http::withHeaders([
            'token' => env('TOKEN'),
            "shop_id" => env('SHOP_ID'),
            'Content-Type' => 'application/json',
        ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', [
            "from_district" => $fromDistrict,
            "to_district" => $toDistrict,
        ])->json()['data'];

        return array_filter($services, fn ($service) => !empty($service['name']));
    }

    public function calculateFeeGhn(array $shipmentInfo)
    {
        $fee = Http::withHeaders([
            'token' => env('TOKEN'),
            "shop_id" => env('SHOP_ID'),
            'Content-Type' => 'application/json',
        ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $shipmentInfo)
            ->json()['data']['total'];

        return $fee;
    }

    public function getProvinces()
    {
        return Cache::remember('provinces', 60 * 60 * 24, function () {
            $provinces = Http::withHeaders([
                'token' => env('TOKEN'),
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
                'token' => env('TOKEN'),
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
                'token' => env('TOKEN'),
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
