<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LearningResource;
use App\Models\Learning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LearningController extends Controller
{
    public function index()
    {
        //get all posts
        $learnings = Learning::latest()->paginate(5);
        //return collection of heroes as a resource
        return new LearningResource(true, 'List Data Learning Resource', $learnings);
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
        $image->storeAs('public/learning-resource', $image->hashName());

        //create post
        $learnings = Learning::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description,
        ]);

        //return response
        return new LearningResource(true, 'Data Learning Resource Berhasil Ditambahkan!', $learnings);
    }

    public function show($id)
    {
        $learnings = Learning::find($id);
        return new LearningResource(true, 'Detail Data Learning Resource!', $learnings);
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

        $learnings = Learning::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/learning-resource', $image->hashName());

            Storage::delete('public/learning-resource/'.basename($learnings->image));

            $learnings->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        
        } else {
            $learnings->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        }

        return new LearningResource(true, 'Data Learning Resource Berhasil Diubah', $learnings);
    }

    public function destroy($id)
    {
        $learnings = Learning::find($id);

        Storage::delete('public/learning-resource/'.basename($learnings->image));

        $learnings->delete();

        return new LearningResource(true, 'Data Learning Resource Berhasil Dihapus!', null);
    }
}
