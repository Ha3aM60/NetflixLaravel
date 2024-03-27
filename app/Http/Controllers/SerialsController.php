<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SerialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete','searchByTitle']]);
    }
    public function index()
    {
        $movies = Serial::get();
        return response()->json($movies, 200);
    }
    public static function searchByTitle($title)
    {
        $limit = 10;
        return Serial::where('title', 'like', '%' . $title . '%')->limit($limit)->get();
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'time' => 'required|string',
            'title' => 'required|string',
            'directorId' => 'required|int',
            'age' => 'required|string',
            'year' => 'required|string'
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
        $item= Serial::create([
            'country'=>$request['country'],
            'description'=>$request['description'],
            'image'=> $input["image"],
            'slug'=>$request['slug'],
            'time'=>$request['time'],
            'title'=>$request['title'],
            'directorId'=>$request['directorId'],
            'age'=>$request['age'],
            'year'=>$request['year']
        ]);
        return response()->json($item);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'country' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'time' => 'required|string',
            'title' => 'required|string',
            'directorId' => 'required|int',
            'age' => 'required|string',
            'year' => 'required|string'
        ]);

        if ($request->has("image")) {
            if ($item["image"] != null && $item["image"] != "") {
                $imagePath = public_path('uploads/' . $item->image);

                if (Storage::disk('public')->exists($item->image)) {
                    Storage::disk('public')->delete($item->image);
                } elseif (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $filename = uniqid() . '.' . $request->file("image")->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads'), $filename);
            $validatedData["image"] = $filename;
        }
        $itemUpdate = Serial::where("id",$request["id"])->first();
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
        $itemDelete = Serial::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
