<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){


    Route::get('/tasks', [\App\Http\Controllers\Api\TaskController::class, 'getTasks']);

    Route::post('/tasks', [\App\Http\Controllers\Api\TaskController::class, 'store']);

    Route::get('/tasks/{id}', [\App\Http\Controllers\Api\TaskController::class, 'show']);

    Route::put('/tasks/{id}', [\App\Http\Controllers\Api\TaskController::class, 'update']);

    Route::delete('/tasks/{id}', [\App\Http\Controllers\Api\TaskController::class, 'destroy']);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {

   $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password) // Hash the password
    ]);

   $user = $user->createToken('auth_token')->plainTextToken;

   foreach ($user->tokens as $token) {
       dd($user->tokens, $token);
   }
});