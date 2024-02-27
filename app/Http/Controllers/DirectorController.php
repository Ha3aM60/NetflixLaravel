<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = Directors::all();
        return view('directors.index', compact('directors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'placeOfBirth' => 'required',
            'birthday' => 'required|date',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Directors::create([
            'name' => $request->name,
            'image' => $imageName,
            'placeOfBirth' => $request->placeOfBirth,
            'birthday' => $request->birthday,
        ]);

        return redirect()->route('directors.index')
            ->with('success', 'Director created successfully.');
    }

    public function edit($id)
    {
        $director = Directors::findOrFail($id);

        return view('directors.edit', compact('director'));
    }

    public function destroy($id)
    {
        $director = Directors::findOrFail($id);
        $director->delete();

        return redirect()->route('directors.index')
            ->with('success', 'Director deleted successfully.');
    }
}
