<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request): JsonResponse
    {
        // Extract email and password from request
        $email = $request->email;
        $password = $request->password;

        DB::beginTransaction();
        try {
            // Attempt authentication
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyToken')->accessToken;
                $success['name'] = $user;

                DB::commit();
                return $this->sendResponse($success, 'User login successful.');
            } else {
                return $this->sendError('Unauthorized', ['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Internal Server Error', ['error' => $e->getMessage()], 500);
        }
    }


    public function register(AuthRegisterRequest $request): JsonResponse
    {
        // Extracting input data
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $user->assignRole('User');

            // Generating token
            $success['token'] = $user->createToken('MyToken')->accessToken;
            $success['name'] = $user->name;

            DB::commit();
            return $this->sendResponse($success, 'User registered successfully.');
        } catch (\Exception $e) {
            // Handling unexpected exceptions
            DB::rollBack();
            return $this->sendError('Internal Server Error', ['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {

        auth()->user()->token()->revoke();

        return response()->json([], 204);
    }
}
