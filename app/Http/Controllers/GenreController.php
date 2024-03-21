<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
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

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string'
    ]);
    $itemUpdate = Genre::find($id);
    if (!$itemUpdate) {
        return response()->json(['message' => 'Genre not found'], 404);
    }
    $itemUpdate->update($validatedData);
    return response()->json(['message' => 'Complete!'], 200);
}

    public function delete($id)
{
    $itemDelete = Genre::find($id);
    if (!$itemDelete) {
        return response()->json(['error' => 'Genre not found'], 404);
    }
    $itemDelete->delete();
    return response()->json(['message' => 'Genre deleted successfully'], 200);
}
}
