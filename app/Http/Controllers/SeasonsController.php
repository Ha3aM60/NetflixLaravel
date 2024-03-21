<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeasonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }
    public function index()
    {
        $movies = Season::get();
        return response()->json($movies, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|string',
            'number' => 'required|int',
            'serialId' => 'required|int',
            'title' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= Season::create([
            'year'=>$request['year'],
            'number'=>$request['number'],
            'serialId'=>$request['serialId'],
            'title'=>$request['title']
        ]);
        return response()->json($item);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'year' => 'required|string',
            'number' => 'required|int',
            'serialId' => 'required|int',
            'title' => 'required|string'
        ]);
        $itemUpdate = Season::where("id",$request["id"])->first();
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
        $itemDelete = Season::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
