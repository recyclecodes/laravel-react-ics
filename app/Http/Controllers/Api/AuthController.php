<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
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
                $success['name'] = $user->name;

                DB::commit();
                return $this->sendResponse($success, 'User login successful.');
            } else {
                return $this->sendError('Unauthorized', ['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Server Error', [$e->getMessage()], 500);
        }





    }

}
