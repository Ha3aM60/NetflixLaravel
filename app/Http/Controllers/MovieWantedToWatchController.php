<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\movieWantedToWatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovieWantedToWatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store', 'delete']]);
    }
    public function index($id)
    {
        $moviesAll = [];
        $moviesId= movieWantedToWatch::where('userId', $id)->get();

        foreach ($moviesId as $movies) {
            $wanted = Movies::where('id', $movies['moviesId'])->first();
            $moviesAll[] = $wanted;
        }

        return response()->json([
            'movies' => $moviesAll
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moviesId' => 'required|int',
            'userId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= movieWantedToWatch::create([
            'moviesId'=>$request['moviesId'],
            'userId'=>$request['userId']
        ]);

        return response()->json($item);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $itemDelete = movieWantedToWatch::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
