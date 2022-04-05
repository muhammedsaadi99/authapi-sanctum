<?php

use App\Http\Controllers\auth\v1\LoginController;
use App\Http\Controllers\auth\v1\LogoutController;
use App\Http\Controllers\auth\v1\RegisterController;
use App\Http\Controllers\auth\v1\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::put('user/{id}', [UpdateController::class, 'update']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/logout', [LogoutController::class, 'logout']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
