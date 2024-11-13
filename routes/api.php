<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


//Route::post('/register', RegistrationController::class);
//Route::post('/login', LoginController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/refresh', [AuthController::class, 'refreshToken']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/about', [AuthController::class, 'about']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/protected-route', function () {
    return response()->json(['message' => 'Access granted']);
});
