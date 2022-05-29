<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostApiController;
use App\Http\Controllers\Api\V1\CommentApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/post/{title}',[PostApiController::class,'getPostByTitle']);
Route::get('/filter/by/',[PostApiController::class,'filterByCreatedAt']);
Route::apiResources([
    'posts' => PostApiController::class,
    'comments' => CommentApiController::class,
]);

