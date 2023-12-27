<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Models\Hero;
use Illuminate\Support\Facades\Storage;
//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class HeroController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $heroes = Hero::latest()->paginate(5);

        //return collection of heroes as a resource
        return new HeroResource(true, 'List Data heroes', $heroes);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title'     => 'required',
            'description'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/heroes', $image->hashName());

        //create post
        $heroes = Hero::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description,
        ]);

        //return response
        return new HeroResource(true, 'Data Post Berhasil Ditambahkan!', $heroes);
    }

    public function show($id)
    {
        $heroes = Hero::find($id);
        return new HeroResource(true, 'Detail Data Hero!', $heroes);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $heroes = Hero::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/heroes', $image->hashName());

            Storage::delete('public/heroes/'.basename($heroes->image));

            $heroes->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        
        } else {
            $heroes->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        }

        return new HeroResource(true, 'Data Hero Berhasil Diubah', $heroes);
    }

    public function destroy($id)
    {
        $heroes = Hero::find($id);

        Storage::delete('public/heroes/'.basename($heroes->image));

        $heroes->delete();

        return new HeroResource(true, 'Data Hero Berhasil Dihapus!', null);
    }
}