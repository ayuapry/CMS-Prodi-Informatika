<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view("admin.hero.index", ["heroes" => $heroes]);
    }

    public function create()
    {
        return view("admin.hero.add");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "image" => "required|image|mimes:jpg,jpeg,png",
            "title" => "required",
            "description" => "required"
        ]);

        $saveImage['image'] = Storage::putFile('public/heroes', $request->file('image'));

        Hero::create([
            "image" =>  $saveImage["image"],
            "title" => $validated["title"],   
            "description" => $validated["description"]     
        ]);

        return redirect('/admin/hero');
    }

    public function show(string $id)
    {
        $heroes = Hero::findOrFail($id);
        return view('admin.hero.edit', ['hero' => $heroes]);
    }

    public function update(Request $request, string $id)
    {
        $heroes = Hero::findOrFail($id);
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($heroes->image);
            $newImage = ['image' => Storage::putFile('public/heroes', $request->file('image'))];
        } else {
            $newImage = ['image' => $heroes-> image];
        }

        Hero::where('id', $id)->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $newImage['image']
        ]);

        return redirect('/admin/hero');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hero::destroy($id);
        return redirect('/admin/hero');
    }}
