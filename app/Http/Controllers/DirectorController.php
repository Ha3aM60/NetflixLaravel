<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Directors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ImageHelper;

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
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'placeOfBirth' => 'nullable|string',
            'birthday' => 'nullable|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if (!$request->has('image')) {
            return response()->json(['message' => 'Missing file'], 422);
        }
        $dir = $_SERVER['DOCUMENT_ROOT'];
        $year = date('Y');
        $month = date('m');
        $basePath = $dir . '/uploads/' . $year . '/' . $month;
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $filename = uniqid() . '.' . $request->file("image")->getClientOriginalExtension();
        $fileSave = $basePath . '/' . $filename;
        ImageHelper::image_resize(700, 700, $fileSave, 'image');
        $input["image"] = $year . '/' . $month . '/' . $filename;
        $director = Directors::create([
            'name' => $request['name'],
            'image' => $input['image'],
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
