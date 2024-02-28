<?php

namespace App\Http\Controllers;

use App\Models\actorMovies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ActorMoviesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }

    public function index()
    {
        $actorMoviesData = DB::table('actor_movies')
            ->select('actor_movies.*', 'actors.name as actors_name', 'movies.title as movie_title')
            ->join('actors', 'actor_movies.actorId', '=', 'actors.id')
            ->join('movies', 'actor_movies.actorId', '=', 'movies.id')
            ->get();
        return response()->json($actorMoviesData, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moviesId' => 'required|int',
            'actorId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= actorMovies::create([
            'moviesId'=>$request['moviesId'],
            'actorId'=>$request['actorId']
        ]);
        return response()->json($item);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'actorId' => 'required|string'
        ]);
        $itemUpdate = actorMovies::where("id",$request["id"])->first();
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
        $itemDelete = actorMovies::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
