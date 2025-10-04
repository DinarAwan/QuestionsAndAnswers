<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PostinganController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/postingan-create', [PostinganController::class, 'store']);
    Route::patch('/postingan-update/{id}', [PostinganController::class, 'update'])->middleware('PemilikPostingan');
    Route::delete('/postingan-delete/{id}', [PostinganController::class, 'destroy'])->middleware('PemilikPostingan');

    Route::post('create-komentar', [KomentarController::class, 'store']);
    Route::patch('update-komentar/{id}', [KomentarController::class, 'update'])->middleware('PemilikKomentar');
    Route::delete('delete-komentar/{id}', [KomentarController::class, 'destroy'])->middleware('PemilikKomentar');
    Route::post('like-komentar/{id}', [KomentarController::class, 'likeKomentar']);
    Route::get('count-likes-komentar/{komentarId}', [KomentarController::class, 'countLikesByKomentarId']);
    Route::get('short-like-komentar-asc', [KomentarController::class, 'shorLikeKomentarASC']);
});


Route::get('/postingan', [PostinganController::class, 'index']);
Route::get('/show/{id}', [PostinganController::class, 'show'])->middleware('auth:sanctum');
Route::get('/postingan-with-komentars/{postinganId}', [KomentarController::class, 'getPostinganWithKomentars']);

Route::get('get-komentar/{postinganId}', [KomentarController::class, 'getKomentarByPostinganId']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
