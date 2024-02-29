<?php

namespace App\Http\Controllers;

use App\Models\genreMovies;
use App\Models\genreSerials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GenreSerialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }
    public function index()
    {
        $genreMoviesData = DB::table('genre_serials')
            ->select('genre_serials.*', 'genres.name as genre_name', 'serials.title as serial_title')
            ->join('genres', 'genre_serials.genreId', '=', 'genres.id')
            ->join('serials', 'genre_serials.serialsId', '=', 'serials.id')
            ->get();
        return response()->json($genreMoviesData, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialsId' => 'required|int',
            'genreId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= genreSerials::create([
            'serialsId'=>$request['serialsId'],
            'genreId'=>$request['genreId']
        ]);
        return response()->json($item);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'genreId' => 'required|string'
        ]);
        $itemUpdate = genreSerials::where("id",$request["id"])->first();
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
        $itemDelete = genreSerials::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
