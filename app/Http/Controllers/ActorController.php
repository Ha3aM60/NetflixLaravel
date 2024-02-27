<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actors::all();
        return view('actors.index', compact('actors'));
    }
    public function edit($id)
    {
        $actor = Actors::findOrFail($id);

        return view('actors.edit', compact('actor'));
    }
    public function destroy($id)
    {
        $actor = Actors::findOrFail($id);
        $actor->delete();

        return redirect()->route('actors.index')
            ->with('success','Actor deleted successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'placeOfBirth' => 'required',
            'birthday' => 'required|date',
            'description' => 'required',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Actors::create([
            'name' => $request->name,
            'image' => $imageName,
            'placeOfBirth' => $request->placeOfBirth,
            'birthday' => $request->birthday,
            'description' => $request->description,
        ]);

        return redirect()->route('actors.index')
            ->with('success','Actor created successfully.');
    }
}
