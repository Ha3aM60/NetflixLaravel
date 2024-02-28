<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\ActorMoviesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GenreMoviesController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\MovieWantedToWatchController;
use App\Http\Controllers\MovieFavoriteController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'genre'
], function () {
    Route::get('/index', [GenreController::class, 'index']);
    Route::post('/store', [GenreController::class, 'store']);
    Route::post('/update', [GenreController::class, 'update']);
    Route::post('/delete', [GenreController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'actors'
], function () {
    Route::get('/index', [ActorController::class, 'index']);
    Route::post('/store', [ActorController::class, 'store']);
    Route::post('/update', [ActorController::class, 'update']);
    Route::post('/delete', [ActorController::class, 'delete']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'genreMovies'
], function () {
    Route::get('/index', [GenreMoviesController::class, 'index']);
    Route::post('/store', [GenreMoviesController::class, 'store']);
    Route::post('/update', [GenreMoviesController::class, 'update']);
    Route::post('/delete', [GenreMoviesController::class, 'delete']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'actorMovies'
], function () {
    Route::get('/index', [ActorMoviesController::class, 'index']);
    Route::post('/store', [ActorMoviesController::class, 'store']);
    Route::post('/update', [ActorMoviesController::class, 'update']);
    Route::post('/delete', [ActorMoviesController::class, 'delete']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'wantedToWatch'
], function () {
    Route::get('/index/{id}', [MovieWantedToWatchController::class, 'index']);
    Route::post('/store', [MovieWantedToWatchController::class, 'store']);
    Route::post('/delete', [MovieWantedToWatchController::class, 'delete']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'favoritesMovies'
], function () {
    Route::get('/index/{id}', [MovieFavoriteController::class, 'index']);
    Route::post('/store', [MovieFavoriteController::class, 'store']);
    Route::post('/delete', [MovieFavoriteController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'movies'
], function () {
    Route::get('/index', [MoviesController::class, 'index']);
    Route::post('/store', [MoviesController::class, 'store']);
    Route::post('/update', [MoviesController::class, 'update']);
    Route::post('/delete', [MoviesController::class, 'delete']);

});
