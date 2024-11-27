<?php

namespace App\Http\Controllers\V1;

use App\Models\country;
use App\Http\Requests\StorecountryRequest;
use App\Http\Requests\UpdatecountryRequest;
use App\Http\Controllers\Controller;
use Dotenv\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return country::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecountryRequest $request)
    {
        $country = country::create($request->validated());
        return response()->json($country);
    }

    /**
     * Display the specified resource.
     */
    public function show(country $country)
    {
        return response()->json($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecountryRequest $request, country $country)
    {
        $country->update($request->validated());
        return response()->json($country, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(country $country)
    {
        $country->delete();
        return response()->json(['deleted!'],200);
    }
}
