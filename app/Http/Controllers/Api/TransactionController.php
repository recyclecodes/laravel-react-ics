<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use DB;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transaction = Transaction::all();
        return $this->sendResponse(TransactionResource::collection($transaction), 'Transactions retrieve successfully');
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
    public function store(StoreTransactionRequest $request): JsonResponse
    {

        // try {
        //     DB::transaction(function() {

        //     })
        // }
        // catch(\Exception $e) {

        // }

        DB::beginTransaction();
        try {
            $input = $request->all();
            $transaction = Transaction::create($input);

            if ($transaction) {
                DB::commit();

                return $this->sendResponse(new TransactionResource($transaction), 'Transaction saved successfully', 201);


            } else {
                DB::rollBack();

                return $this->sendError(null, 'Failed to save transaction', 409);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->id;

        if (is_null($transaction)) {
            return $this->sendError('Transaction not found');
        }
        return $this->sendResponse(new TransactionResource($transaction), 'Transaction retrieved successfully', 201);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $transaction->name = $input['name'];
            $transaction->description = $input['description'];
            $transaction::update($input);

            DB::commit();

            return $this->sendResponse(new TransactionResource($transaction), 'Transaction updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(Transaction $transaction)
    {
        $transaction->id;
        $transaction->delete();
        return response()->json([], 204);
    }
}
