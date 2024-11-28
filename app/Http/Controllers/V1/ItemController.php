<?php

namespace App\Http\Controllers\V1;

use App\Models\item;
use App\Http\Requests\StoreitemRequest;
use App\Http\Requests\UpdateitemRequest;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{

    //MAYBE ITEM CAN HAVE EXTRA FIELD TO SHOW SOLD OR GONE boolean
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return item::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreitemRequest $request)
    {
        $item = item::create($request->validated());
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(item $item)
    {
        return response()->json($item);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateitemRequest $request, item $item)
    {
        //LATERRLTEART
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item $item)
    {
        $item->delete();
        return response()->json(['deleted!'],200);
    }
}
