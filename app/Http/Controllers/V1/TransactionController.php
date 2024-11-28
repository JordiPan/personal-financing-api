<?php

namespace App\Http\Controllers\V1;

use App\Models\transaction;
use App\Http\Requests\StoretransactionRequest;
use App\Http\Requests\UpdatetransactionRequest;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(transaction::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretransactionRequest $request)
    {
        $transaction = transaction::create($request->validated());
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransactionRequest $request, transaction $transaction)
    {
        //LATERT
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        $transaction->delete();
        return response()->json(['deleted!'],200);
    }
}
