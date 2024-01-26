<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Achievment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievmentController extends Controller
{
    public function index()
    {
        $achievments = Achievment::all();
        return view("admin.achievment.index", ["achievments" => $achievments]);
    }

    public function create()
    {
        return view("admin.achievment.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png,pdf',
            'title'         => 'required',
            'content'       => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/achievments', $image->hashName());

        Achievment::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'content'       => $request->content
        ]);


        return redirect('/admin/achievment');
    }

    public function show(string $id)
    {
        $achievments = Achievment::findOrFail($id);
        return view('admin.achievment.edit', ['achievment' => $achievments]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'         => 'mimes:jpeg,jpg,png,pdf',
            'title'         => 'string',
            'content'       => 'string'
        ]);

        //get post by ID
        $achievments = Achievment::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/achievments', $image->hashName());

            //delete old image
            Storage::delete('public/achievments/'.$achievments->image);

            //update post with new image
            $achievments->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'content'       => $request->content
            ]);

        } else {

            //update post without image
            $achievments->update([
                'title'         => $request->title,
                'content'       => $request->content
            ]);
        }

        return redirect('/admin/achievment');
    }

    public function destroy(string $id)
    {
        $achievments = Achievment::findOrFail($id);

        //delete image
        Storage::delete('public/achievments/'. $achievments->image);

        //delete post
        $achievments->delete();

        return redirect('/admin/achievment');
    }

}
