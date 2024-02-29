<?php

namespace App\Http\Controllers;


use App\Models\Serial;
use App\Models\serialsWantedToWatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SerialsWantedToWatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store', 'delete']]);
    }
    public function index($id)
    {
        $serialAll = [];
        $serialId= serialsWantedToWatch::where('userId', $id)->get();

        foreach ($serialId as $serial) {
            $wanted = Serial::where('id', $serial['serialsId'])->first();
            $serialAll[] = $wanted;
        }

        return response()->json([
            'serials' => $serialAll
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialsId' => 'required|int',
            'userId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= serialsWantedToWatch::create([
            'serialsId'=>$request['serialsId'],
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
        $itemDelete = serialsWantedToWatch::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
