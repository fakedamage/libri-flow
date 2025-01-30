<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/sign-up', [AuthController::class, 'sign_up'])->withoutMiddleware('auth:api');
Route::post('/auth/sign-in', [AuthController::class, 'sign_in'])->withoutMiddleware('auth:api');

#Module Book
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::post('/books/{id}/reserve', [BookController::class, 'reserve']);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working fine!']);
});
