<?php

use App\Http\Controllers\AuthConttroller;
use App\Http\Controllers\ClientConttroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::post('login', function () {
//     return response()->json('hello word');
// });

 Route::controller(AuthConttroller::class)->group(function (){
     Route::post('login','login');
   
 });
 Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('logout',[AuthConttroller::class,'logout']);
    Route::post('sheck',[AuthConttroller::class,'sheck']);
 });

 Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/client',[ClientConttroller::class,'store']);
    Route::get('/clients',[ClientConttroller::class,'index']);
    Route::get('/client/{id}',[ClientConttroller::class,'getById']);
    Route::delete('/client/{id}',[ClientConttroller::class,'destroy']);
    Route::put('/client/{id}',[ClientConttroller::class,'update']);
});



