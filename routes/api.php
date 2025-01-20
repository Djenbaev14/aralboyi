<?php

use App\Http\Controllers\Api\PostController;
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

// route api resource
// Route::apiResource('posts', 'Post');

// route api
Route::apiResource('posts', PostController::class);
Route::get('/about-us', [PostController::class, 'about']);
Route::get('/videos', [PostController::class, 'videos']);
Route::get('/photos', [PostController::class, 'photos']);