<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratories = Laboratory::all();
        return view("admin.laboratory.index", ["laboratories" => $laboratories]);
    }

    public function create()
    {
        return view("admin.laboratory.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png,pdf',
            'title'     => 'required',
            'content'   => 'required',
            'slug'      => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/laboratories', $image->hashName());

        Laboratory::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'content'       => $request->content,
            'slug'          => $request->slug
        ]);


        return redirect('/admin/laboratory');
    }

    public function show(string $id)
    {
        $laboratories = Laboratory::findOrFail($id);
        return view('admin.laboratory.edit', ['laboratory' => $laboratories]);
    }

    public function update(Request $request, string $slug)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png,pdf',
            'title'     => 'string',
            'content'   => 'string'
        ]);

        //get post by ID
        $laboratories = Laboratory::findOrFail($slug);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/laboratories', $image->hashName());

            //delete old image
            Storage::delete('public/laboratories/'.$laboratories->image);

            //update post with new image
            $laboratories->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            //update post without image
            $laboratories->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        return redirect('/admin/laboratory');
    }

    public function destroy(string $slug)
    {
        $laboratories = Laboratory::findOrFail($slug);

        //delete image
        Storage::delete('public/laboratories/'. $laboratories->image);

        //delete post
        $laboratories->delete();

        return redirect('/admin/laboratory');
    }
}
