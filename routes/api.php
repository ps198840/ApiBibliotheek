<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthenticationController;

Route::apiResource('books', BookController::class)->only(['index', 'show']);
Route::apiResource('authors', AuthorController::class)
    ->parameters(['authors' => 'author']);
Route::get('authors/{id}/books', [BookController::class, 'indexFunctie']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    //    PROTECTED ROUTES
    Route::apiResource('books', BookController::class)->except(['index', 'show']);
    Route::delete('books/{id}', [BookController::class, 'destroy']);

    Route::get('profile', function(Request $request) { return auth()->user();});
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found'], 404);
});
