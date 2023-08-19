<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout',[AuthenticationController::class, 'logout']);
    Route::get('/me',[AuthenticationController::class, 'me']);

    //create
    Route::post('/posts',[PostController::class, 'store']);
    //update
    Route::patch('/posts/{id}',[PostController::class, 'update'])->middleware('AuthorPost');
    //delete
    Route::delete('/posts/{id}',[PostController::class, 'destroy'])->middleware('AuthorPost');

    Route::post('/comment',[CommentController::class, 'store']);

    Route::patch('/comment/{id}',[CommentController::class, 'update'])->middleware('AuthorComment');

    Route::delete('/comment/{id}',[CommentController::class, 'destroy'])->middleware('AuthorComment');
});

//show
Route::get('/posts',[PostController::class, 'index']);
Route::get('/posts/{id}',[PostController::class, 'show']);
// Route::get('/posts2/{id}',[PostController::class, 'show2']);



Route::post('/login',[AuthenticationController::class, 'login']);
