<?php

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
// Public Route
Route::get('getAllProduct',[App\Http\Controllers\API\ProductController::class,'getAllProduct']);


//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/depositCoin/{email}', [App\Http\Controllers\API\AuthController::class, 'depositCoin']);

//Protecting Routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/update/{id}', [App\Http\Controllers\API\AuthController::class, 'update']);
    Route::get('/edit/{id}', [App\Http\Controllers\API\AuthController::class, 'edit']);
    Route::delete('/delete/{id}', [App\Http\Controllers\API\AuthController::class, 'destroy']);

    Route::post('/buyProduct/{email}', [App\Http\Controllers\API\AuthController::class, 'buyProduct']);

    Route::post('/createProduct', [App\Http\Controllers\API\ProductController::class, 'createProduct']);
    Route::post('deleteProduct/{id?}',[App\Http\Controllers\API\ProductController::class,'deleteProduct']);
    Route::put('updateProduct/{id?}',[App\Http\Controllers\API\ProductController::class,'updateProduct']);

    Route::post('updateProduct/{id?}',[App\Http\Controllers\API\ProductController::class,'updateProduct']);
    Route::post('/searchProduct/{name}', [App\Http\Controllers\API\ProductController::class, 'searchProduct']);
    Route::patch('store',[App\Http\Controllers\API\ProductController::class,'store']);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});






