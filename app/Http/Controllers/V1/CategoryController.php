<?php

namespace App\Http\Controllers\V1;

use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * /api/v1/categories/
     * category::paginate()
     * php artisan make:resource v1/CategoryResource for easy transforming data (DTO)
     */
    public function index()
    {
        $user = Auth::user();
        $categories = category::where('user_id',$user->id)->get();
        return response()->json(['categories'=>$categories], 200);
    }
    /**
     * Store a newly created resource in storage.
     * POST /api/v1/categories/
     */
    public function store(StorecategoryRequest $request)
    {
        $formCategory = $request->validated();
        $user = Auth::user();
        $formCategory['user_id'] = $user->id;
        $category = category::create($formCategory);
        return response()->json(['message' => 'created!', 'category' => $category],200);
    }

    /**
     * Display the specified resource.
     * /api/v1/categories/{id}
     */
    public function show(category $category)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->can('view', $category)) {
            return response()->json(['message' => 'no privileges'], 403);
        }
        $category = $category->load(['items' => function($query){
            $query->orderBy('created_at', 'asc');
        }]);
        $category->items->load('country');
        return response()->json(['message' => 'Items gotten!', 'items' => $category->items],200);;
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
