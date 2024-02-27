<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\Genre\StoreRequest;
use App\Http\Requests\Genre\UpdateRequest;
use Illuminate\Support\Facades\Validator;


class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }

    public function index()
    {
        $genre = Genre::get();
        return response()->json($genre, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= Genre::create([
            'name'=>$request['name'],
        ]);
        return response()->json($item);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);
        $itemUpdate = Genre::where("id",$request["id"])->first();
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
        $itemDelete = Genre::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
