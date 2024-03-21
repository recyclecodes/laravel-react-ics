<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {

        // search and query
        // $admin = User::when($request->filled('search'), function ($seach) use ($request) {
        //     $seach->where('name', 'LIKE', '%' . $request->search . '%');
        // })
        //     ->when($request->filled('role'), function ($query) use ($request) {
        //         $query->whereHas('roles', function ($query) use ($request) {
        //             $query->where('name', $request->role);
        //         });
        //     })->with('roles')->get();


        $admin = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();
        return $this->sendResponse($admin, 'Admin users retrieve successgully');
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
        DB::beginTransaction();
        try {
            $input = $request->all();
            $admin = User::create($input);

            if ($admin) {
                DB::commit();

                return $this->sendResponse(new UserResource($admin), 'Admin admin saved successfully', 201);


            } else {
                DB::rollBack();

                return $this->sendError(null, 'Failed to save admin admin', 409);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        // $admin->id;
        $data = User::with('company')->find($admin->id);

      
        return $this->sendResponse($data, 'User retrieved successfully', 201);

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $admin, $id)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $admin = User::find($id);
            $admin->name = $input['name'];
            $admin->email = $input['email'];
            $admin->contact = $input['contact'];
            $admin->save();

            DB::commit();

            return $this->sendResponse(new UserResource($admin), 'Admin User updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(User $admin, $id)
    {
        $admin = User::find($id);
        $admin->delete();
        return $this->sendResponse('User archived successfully', 204);
    }
}
