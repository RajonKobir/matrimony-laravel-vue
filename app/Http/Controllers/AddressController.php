<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Postcode;
use App\Models\UnionParishad;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getDivisions(string $country_id)
    {
        $divisions = Division::all();
        return $divisions;
    }

    public function getDistricts(string $division_id)
    {
        $districts = District::where('division_id', $division_id)->get();
        return $districts;
    }

    public function getUpazilas(string $district_id)
    {
        // $upazilas = Upazila::where('district_id', $district_id)->get();
        $upazilas = UnionParishad::where('district_id', $district_id)->get();
        return $upazilas;
    }

    public function getPostcodes(string $upazila_name)
    {
        $postcodes = Postcode::where('upazila_name', 'LIKE', '%' . $upazila_name . '%')->get();
        return $postcodes;
    }

    public function getUnionParishads(string $upazila_name)
    {
        $union_parishads = UnionParishad::where('upazila', 'LIKE', '%' . $upazila_name . '%')->get();
        return $union_parishads;
    }

}
