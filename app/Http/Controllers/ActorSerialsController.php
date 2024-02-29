<?php

namespace App\Http\Controllers;

use App\Models\actorSerials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActorSerialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','store','update', 'delete']]);
    }
    public function index()
    {
        $actorMoviesData = DB::table('actor_serials')
            ->select('actor_serials.*', 'actors.name as actors_name', 'serials.title as serials_title')
            ->join('actors', 'actor_serials.actorId', '=', 'actors.id')
            ->join('serials', 'actor_serials.serialId', '=', 'serials.id')
            ->get();
        return response()->json($actorMoviesData, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serialId' => 'required|int',
            'actorId' => 'required|int'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $item= actorSerials::create([
            'serialId'=>$request['serialId'],
            'actorId'=>$request['actorId']
        ]);
        return response()->json($item);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'actorId' => 'required|string'
        ]);
        $itemUpdate = actorSerials::where("id",$request["id"])->first();
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
        $itemDelete = actorSerials::where("id",$request["id"])->first();
        $itemDelete ->delete();
        return response()->json(['message'=>'Complete!'],200);
    }
}
