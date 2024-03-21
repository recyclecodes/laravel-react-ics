<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateItemRequest;
use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $item = Item::all();
        return $this->sendResponse(ItemResource::collection($item), 'Items retrieve successfully');
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
    public function store(StoreItemRequest $request): JsonResponse
    {

        DB::beginTransaction();
        try {
            $input = $request->all();
            $item = Item::create($input);

            if ($item) {
                DB::commit();

                return $this->sendResponse(new ItemResource($item), 'Item saved successfully', 201);


            } else {
                DB::rollBack();

                return $this->sendError(null, 'Failed to save item', 409);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->id;

        if (is_null($item)) {
            return $this->sendError('Item not found');
        }
        return $this->sendResponse(new ItemResource($item), 'Item retrieved successfully', 201);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $item->name = $input['name'];
            $item->description = $input['description'];
            $item->save();

            DB::commit();

            return $this->sendResponse(new ItemResource($item), 'Item updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(Item $item)
    {
        $item->id;
        $item->delete();
        return response()->json([], 204);
    }
}
