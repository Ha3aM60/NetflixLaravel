<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\ActorMoviesController;
use App\Http\Controllers\ActorSerialsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GenreMoviesController;
use App\Http\Controllers\GenreSerialsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\MovieWantedToWatchController;
use App\Http\Controllers\MovieFavoriteController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SerialFavoriteController;
use App\Http\Controllers\SerialsController;
use App\Http\Controllers\SerialsWantedToWatchController;
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
    'prefix' => 'moviesWantedToWatch'
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'serials'
], function () {
    Route::get('/index', [SerialsController::class, 'index']);
    Route::post('/store', [SerialsController::class, 'store']);
    Route::post('/update', [SerialsController::class, 'update']);
    Route::post('/delete', [SerialsController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'actorSerials'
], function () {
    Route::get('/index', [ActorSerialsController::class, 'index']);
    Route::post('/store', [ActorSerialsController::class, 'store']);
    Route::post('/update', [ActorSerialsController::class, 'update']);
    Route::post('/delete', [ActorSerialsController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'genreSerials'
], function () {
    Route::get('/index', [GenreSerialsController::class, 'index']);
    Route::post('/store', [GenreSerialsController::class, 'store']);
    Route::post('/update', [GenreSerialsController::class, 'update']);
    Route::post('/delete', [GenreSerialsController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'genreSerials'
], function () {
    Route::get('/index', [GenreSerialsController::class, 'index']);
    Route::post('/store', [GenreSerialsController::class, 'store']);
    Route::post('/update', [GenreSerialsController::class, 'update']);
    Route::post('/delete', [GenreSerialsController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'serialsWantedToWatch'
], function () {
    Route::get('/index/{id}', [SerialsWantedToWatchController::class, 'index']);
    Route::post('/store', [SerialsWantedToWatchController::class, 'store']);
    Route::post('/delete', [SerialsWantedToWatchController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'favoritesSerial'
], function () {
    Route::get('/index/{id}', [SerialFavoriteController::class, 'index']);
    Route::post('/store', [SerialFavoriteController::class, 'store']);
    Route::post('/delete', [SerialFavoriteController::class, 'delete']);

});
Route::group([
    'middleware' => 'api',
    'prefix' => 'seasons'
], function () {
    Route::get('/index', [SeasonsController::class, 'index']);
    Route::post('/store', [SeasonsController::class, 'store']);
    Route::post('/update', [SeasonsController::class, 'update']);
    Route::post('/delete', [SeasonsController::class, 'delete']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'episodes'
], function () {
    Route::get('/index', [EpisodesController::class, 'index']);
    Route::post('/store', [EpisodesController::class, 'store']);
    Route::post('/update', [EpisodesController::class, 'update']);
    Route::post('/delete', [EpisodesController::class, 'delete']);
});
