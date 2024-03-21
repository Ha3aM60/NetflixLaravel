<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EpisodesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }
    public function index()
    {
        $movies = Episode::get();
        return response()->json($movies, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seasonId' => 'required|int',
            'path' => 'required|string',
            'description' => 'required|string',
            'title' => 'required|string',
            'time' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= Episode::create([
            'seasonId'=>$request['seasonId'],
            'path'=>$request['path'],
            'description'=>$request['description'],
            'title'=>$request['title'],
            'time'=>$request['time']
        ]);
        return response()->json($item);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'seasonId' => 'required|int',
            'path' => 'required|string',
            'description' => 'required|string',
            'title' => 'required|string',
            'time' => 'required|string'
        ]);
        $itemUpdate = Episode::where("id",$request["id"])->first();
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
        $itemDelete = Episode::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
