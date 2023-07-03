<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'getAuthenticatedUser');
});

Route::get('/galleries', [GalleriesController::class, 'index']);
Route::post('/galleries', [GalleriesController::class, 'store']);
Route::get('/galleries/{id}', [GalleriesController::class, 'show']);
Route::put('/galleries/{id}', [GalleriesController::class, 'update']);
Route::delete('/galleries/{id}', [GalleriesController::class, 'destroy']);
Route::get('/comments', [GalleriesController::class, 'showComments']);
Route::post('/comments', [GalleriesController::class, 'postComment']);
Route::delete('/comments/{id}', [GalleriesController::class, 'deleteComment']);
Route::get('/users', [GalleriesController::class, 'showUsers']);
Route::get('/users/{id}', [GalleriesController::class, 'showUser']);
Route::get('/galleries/{id}/comments', [GalleriesController::class, 'showGalleryWithComments']);
Route::get('/authors/{id}', [GalleriesController::class, 'authorGalleries']);
Route::get('/users/{id}/galleries', [GalleriesController::class, 'showUserGalleries']);