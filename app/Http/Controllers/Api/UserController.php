<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use DB;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::all();
        return $this->sendResponse(UserResource::collection($user), 'Users retrieve successgully');
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
    public function store(StoreUserRequest $request): JsonResponse
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
            $user = User::create($input);

            if ($user) {
                DB::commit();

                return $this->sendResponse(new UserResource($user), 'User saved successfully', 201);


            } else {
                DB::rollBack();

                return $this->sendError(null, 'Failed to save user', 409);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->id;

        if (is_null($user)) {
            return $this->sendError('User not found');
        }
        return $this->sendResponse(new UserResource($user), 'User retrieved successfully', 201);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();

            $user->name = $input['name'];
            $user->email = $input['email'];
            $user::update($input);

            DB::commit();

            return $this->sendResponse(new UserResource($user), 'User updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(User $user)
    {
        $user->id;
        $user->delete();
        return response()->json([], 204);
    }
}
