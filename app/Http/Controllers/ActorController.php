<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Actors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }

    public function index()
    {
        $actors = Actors::get();
        return response()->json($actors, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'nullable|string',
            'placeOfBirth' => 'nullable|string',
            'birthday' => 'nullable|string',
            'description' => 'nullable|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $actor = Actors::create([
            'name' => $request['name'],
            'image' => $request['image'],
            'placeOfBirth' => $request['placeOfBirth'],
            'birthday' => $request['birthday'],
            'description' => $request['description']
        ]);
        return response()->json($actor);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|string',
            'placeOfBirth' => 'nullable|string',
            'birthday' => 'nullable|string',
            'description' => 'nullable|string'
        ]);
        $actor = Actors::where("id",$request["id"])->first();
        $actor->update($validatedData);
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
        $actor = Actors::where("id",$request["id"])->first();
        $actor->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
