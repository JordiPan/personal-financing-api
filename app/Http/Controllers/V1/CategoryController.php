<?php

namespace App\Http\Controllers\V1;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * /api/v1/categories/
     * category::paginate()
     * php artisan make:resource v1/CategoryResource voor easy transforming data (DTO)
     */
    public function index()
    {
        $categories = category::with('items')->get();
        return response()->json($categories, 200);
    }
    /**
     * Store a newly created resource in storage.
     * POST /api/v1/categories/
     */
    public function store(StorecategoryRequest $request)
    {
        $category = category::create($request->validated());
        return response()->json($category,200);
    }

    /**
     * Display the specified resource.
     * /api/v1/categories/1
     */
    public function show(category $category)
    {
        $category = category::with('items')->find( $category->id );
        return response()->json($category,200);;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        // ILL DO IT LATER
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json(['deleted!'],200);
    }
}
