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
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'title'     => 'required',
            'description'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/heroes', $image->hashName());

        Hero::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description
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
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png',
            'title'     => 'string',
            'description'   => 'string'
        ]);

        //get post by ID
        $heroes = Hero::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/heroes', $image->hashName());

            //delete old image
            Storage::delete('public/heroes/'.$heroes->image);

            //update post with new image
            $heroes->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //update post without image
            $heroes->update([
                'title'     => $request->title,
                'description'   => $request->description
            ]);
        }

        return redirect('/admin/hero');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $heroes = Hero::findOrFail($id);

        //delete image
        Storage::delete('public/heroes/'. $heroes->image);

        //delete post
        $heroes->delete();

        return redirect('/admin/hero');
    }
}
