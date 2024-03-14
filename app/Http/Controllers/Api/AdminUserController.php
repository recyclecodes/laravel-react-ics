<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Adminuser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserResource;
use App\Http\Requests\StoreAdminUserRequest;
use App\Http\Requests\UpdateAdminUserRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $admin = Adminuser::all();
        return $this->sendResponse(AdminUserResource::collection($admin), 'Users retrieve successgully');
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
    public function store(StoreAdminUserRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $admin = Adminuser::create($input);

            if ($admin) {
                DB::commit();

                return $this->sendResponse(new AdminUserResource($admin), 'Admin admin saved successfully', 201);


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
    public function show(Adminuser $admin)
    {
        // $admin->id;
        $adminuser = Adminuser::with('company')->find($admin->id);

        $data[] = array(
            "name" => $adminuser["name"],
            "email" => $adminuser["email"],
            'company' => $adminuser["company"]['name']

        );

        if (is_null($data)) {
            return $this->sendError('Admin not found');
        }
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
    public function update(UpdateAdminUserRequest $request, Adminuser $admin, $id)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $admin = Adminuser::find($id);
            $admin->name = $input['name'];
            $admin->email = $input['email'];
            $admin->contact = $input['contact'];
            $admin->save();

            DB::commit();

            return $this->sendResponse(new AdminUserResource($admin), 'Admin User updated successfully', 202);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(Adminuser $admin, $id)
    {
        $admin = Adminuser::find($id);
        $admin->delete();
        return $this->sendResponse('Admin User archived successfully', 204);
    }
}
