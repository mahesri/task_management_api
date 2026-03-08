<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/task', [\App\Http\Controllers\Api\TaskController::class, 'index']);

Route::post('/task', [\App\Http\Controllers\Api\TaskController::class, 'store']);

Route::get('/edit/{id}', [\App\Http\Controllers\Api\TaskController::class, 'edit']);

Route::put('/update/{id}', [\App\Http\Controllers\Api\TaskController::class, 'update']);

Route::delete('/delete/{id}', [\App\Http\Controllers\Api\TaskController::class, 'destroy']);


//Route::get('/task', function (){
//    response()->json([
//            'status' => 200]
//    );
//});
