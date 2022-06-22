<?php

namespace App\Http\Controllers;

use App\Http\Traits\GhnVn;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use GhnVn;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function provinces(Request $request)
    {
        $provinces = $this->getProvinces();

        if ($request->search) {
            $provinces = array_values(
                collect($provinces)
                    ->filter(fn ($item) => str_contains($item->nameExtension, $request->search))
                    ->all()
            );
        }
        return response()->json($provinces);
    }

    public function districts(Request $request)
    {
        $districts = $this->getDistricts($request->provinceId);
        if ($request->search) {
            $districts = array_values(
                collect($districts)
                    ->filter(fn ($item) => str_contains($item->nameExtension, $request->search))
                    ->all()
            );
        }

        return response()->json($districts);
    }

    public function wards(Request $request)
    {
        $wards = $this->getWards($request->districtId);
        if($request->search){
            $wards = array_values(
                collect($wards)
                    ->filter(fn($item) => str_contains($item->nameExtension, $request->search))
                    ->all()
            );
        }
        return response()->json($wards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
