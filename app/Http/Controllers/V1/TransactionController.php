<?php

namespace App\Http\Controllers\V1;

use App\Models\transaction;
use App\Http\Requests\StoretransactionRequest;
use App\Http\Requests\UpdatetransactionRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransactionRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $filters = $request->only(['direction', 'recurrence']);
        $query = Transaction::query();
        $query->where('user_id', $user->id);
        $orderBy = $validated['orderBy'] ?: 'desc';
        $orderMode = $validated['orderMode'] ?: 'full';

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $query->where($key, $value);
            }
        }

        if ($orderMode === 'full') {
            //I already validated it with request rules so injecting is ok
            $query->orderBy('date', $orderBy);
        } else {
            $query->orderByRaw("$orderMode(date) $orderBy");
        }

        if ($amount = $request->query('amount')) {
            $query->limit($amount);
        }
        $query->orderBy('created_at', $orderBy);
        $transactions = $query->where('active', true)->get();
        if ($transactions->isEmpty()) {
            return response()->json(['message' => 'Nothing found', 'transactions' => []], 200);
        }
        if ($request->query('recurrence')) {
            return response()->json([
                'message' => 'success',
                'income' => $transactions->where('direction', 'add')->values(),
                'expenses' => $transactions->where('direction', 'subtract')->values(),
            ], 200);
        }
        $transactions = TransactionResource::collection($transactions);
        return response()->json(['message' => 'success', 'transactions' => $transactions], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretransactionRequest $request)
    {
        try {
            DB::beginTransaction();
            //check if category belongs to the actual user that made the transaction?
            $transactionData = $request->validated();
            $newItems = $transactionData['newItems'] ?? [];
            $existingItems = $transactionData['existingItems'] ?? [];
            $user = Auth::user();
            $registeredItems = [];
            foreach ($newItems as $item) {
                $item['user_id'] = $user->id;
                $newItem = Item::create($item);
                $newItem['quantity'] = $item['quantity'];
                array_push($registeredItems, $newItem);
            }

            //2. make base transaction
            unset($transactionData['existingItems']);
            unset($transactionData['newItems']);
            $transactionData["user_id"] = $user->id;
            $transaction = transaction::create($transactionData);

            //3. make the transaction items
            foreach ($existingItems as $item) {
                $transaction->items()->attach($item['id'], [
                    "quantity" => $item['quantity'],
                    "price_at_purchase" => $item['price']
                ]);
            }

            foreach ($registeredItems as $item) {
                $transaction->items()->attach($item['id'], [
                    "quantity" => $item['quantity'],
                    "price_at_purchase" => $item['price']
                ]);
            }
            DB::commit();
            //4. profit
            return response()->json(['message' => 'made transaction!', 'transaction' => $transaction], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create transaction.',
                'details' => app()->isDebug() ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(transaction $transaction)
    {
        return response()->json(['message' => 'One transaction', 'transaction' => 'Test']);
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
        return response()->json(['deleted!'], status: 200);
    }
}
