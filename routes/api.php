<?php

use App\Http\Controllers\Api\AdminUserController;
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
//Super Admin Routes
Route::middleware('auth:api')->group(function () {
    Route::middleware('role:Super Admin')->group(function () {
        Route::get('/company', [CompanyController::class, 'index']);
        Route::post('/add-company', [CompanyController::class, 'store']);
        Route::get('/company/{company}', [CompanyController::class, 'show']);
        Route::post('/update-company/{id}', [CompanyController::class, 'update']);
        Route::delete('/archive-company/{id}', [CompanyController::class, 'archive']);
        //Add Admin
        Route::get('/admin-user', [AdminUserController::class, 'index']);
        Route::post('/add-admin-user', [AdminUserController::class, 'store']);
        Route::get('/admin-user/{admin}', [AdminUserController::class, 'show']);
        Route::post('/update-admin-user/{id}', [AdminUserController::class, 'update']);
        Route::delete('/archive-admin-user/{id}', [AdminUserController::class, 'archive']);

    });
});
//Admin Routes
Route::middleware('auth:api')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::post('/update-admin-user/{id}', [AdminUserController::class, 'update']);
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/add-user', [UserController::class, 'store']);
        Route::get('/user/{user}', [UserController::class, 'show']);
        Route::post('/update-user/{id}', [UserController::class, 'update']);
        Route::delete('/archive-user/{id}', [UserController::class, 'archive']);
    });
});

//User Routes
Route::middleware('auth:api')->group(function () {
    Route::middleware('role:User')->group(function () {
        return response([
            'res' => 'This route is accessible only to User.'
        ]);
    });
});


// Route::group(['middleware' => 'role:Super Admin'], function () {
//     Route::get('/super-admin', function () {
//         Route::post('/add-company', [CompanyController::class, 'store']);
//         return response([
//             'res' => 'Welcome!'
//         ]);
//     });
// });

// Route::group(['middleware' => 'role:Super Admin', 'role: Admin'], function () {
//     Route::get('/admin', function () {
//         return response([
//             'res' => 'Welcome!'
//         ]);
//     });
// });

Route::middleware('auth:api')->group(function () {
    Route::middleware('role:Super Admin')->get('/super-admin-route', function () {
        return response([
            'res' => 'This route is accessible only to Super Admins.'
        ]);
    });
});

// Route::middleware('auth:api')->group(function () {
//     Route::middleware('check.role:' . Role::findByName('Super Admin')->id)->get('/super-admin-route', function () {
//         return 'This route is accessible only to Super Admins.';
//     });

//     Route::middleware('check.role:' . Role::findByName('Admin')->id)->get('/admin-route', function () {
//         return 'This route is accessible only to Admins.';
//     });

//     Route::middleware('check.role:' . Role::findByName('User')->id)->get('/user-route', function () {
//         return 'This route is accessible only to Users.';
//     });
// });


