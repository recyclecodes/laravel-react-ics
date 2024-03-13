<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//Prvate Routes
Route::group(['middleware' => 'role:Super Admin'], function () {
    Route::get('/super-admin', function () {
        Route::post('/add-company', [CompanyController::class, 'store']);
        return response([
            'res' => 'Welcome!'
        ]);
    });
});

Route::group(['middleware' => 'role:Super Admin', 'role: Admin'], function () {
    Route::get('/admin', function () {
        return response([
            'res' => 'Welcome!'
        ]);
    });
});


