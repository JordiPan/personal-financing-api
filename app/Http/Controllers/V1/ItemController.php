<?php

namespace App\Http\Controllers\V1;

use App\Models\item;
use App\Http\Requests\StoreitemRequest;
use App\Http\Requests\UpdateitemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userItems = item::where('user_id', $user->id)->get();
        return response()->json(['message' => 'items of user here!', 'items' => $userItems], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreitemRequest $request)
    {
        $item = item::create($request->validated());
        return response()->json(['message' => 'Item made!', 'item' => $item], 200);
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
        return response()->json(['deleted!'], 200);
    }
}
