<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Directors;
use Illuminate\Http\Request;
use App\Http\Requests\Directors\StoreRequest;
use App\Http\Requests\Directors\UpdateRequest;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }

    public function index()
    {
        $directors = Directors::get();
        return response()->json($directors, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'nullable|string',
            'placeOfBirth' => 'nullable|string',
            'birthday' => 'nullable|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $director = Directors::create([
            'name' => $request['name'],
            'image' => $request['image'],
            'placeOfBirth' => $request['placeOfBirth'],
            'birthday' => $request['birthday'],
        ]);
        return response()->json($director);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|string',
            'placeOfBirth' => 'nullable|string',
            'birthday' => 'nullable|string'
        ]);
        $director = Directors::where("id",$request["id"])->first();
        $director->update($validatedData);
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
        $director = Directors::where("id",$request["id"])->first();
        $director->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
