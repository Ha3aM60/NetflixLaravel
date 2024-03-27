<?php

namespace App\Http\Controllers;

use App\Models\genreMovies;
use App\Models\Genre;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class GenreMoviesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete','searchByGenre']]);
    }

    public function index()
    {
        $genreMoviesData = DB::table('genre_movies')
            ->select('genre_movies.*', 'genres.name as genre_name', 'movies.title as movie_title')
            ->join('genres', 'genre_movies.genreId', '=', 'genres.id')
            ->join('movies', 'genre_movies.moviesId', '=', 'movies.id')
            ->get();
        return response()->json($genreMoviesData, 200);
    }
    public static function searchByGenre($genreId)
    {
        $limit =10;
        return genreMovies::where('genreId', 'like', '%' . $genreId . '%')->limit($limit)->get();
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moviesId' => 'required|int',
            'genreId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= genreMovies::create([
            'moviesId'=>$request['moviesId'],
            'genreId'=>$request['genreId']
        ]);
        return response()->json($item);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'genreId' => 'required|string'
        ]);
        $itemUpdate = genreMovies::where("id",$request["id"])->first();
        $itemUpdate->update($validatedData);
        return response()->json(['message'=>'Complete!'],200);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $itemDelete = genreMovies::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }

}
