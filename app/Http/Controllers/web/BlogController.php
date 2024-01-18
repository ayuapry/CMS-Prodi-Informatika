<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view("admin.blog.index", ["blogs" => $blogs]);
    }

    public function create()
    {
        return view("admin.blog.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png,pdf',
            'title'     => 'required',
            'description'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        Blog::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description
        ]);


        return redirect('/admin/blog');
    }

    public function show(string $id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blog.edit', ['blog' => $blogs]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png,pdf',
            'title'     => 'string',
            'description'   => 'string'
        ]);

        //get post by ID
        $blogs = Blog::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());

            //delete old image
            Storage::delete('public/blogs/'.$blogs->image);

            //update post with new image
            $blogs->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //update post without image
            $blogs->update([
                'title'         => $request->title,
                'description'   => $request->description
            ]);
        }

        return redirect('/admin/blog');
    }

    public function destroy(string $id)
    {
        $blogs = Blog::findOrFail($id);

        //delete image
        Storage::delete('public/blogs/'. $blogs->image);

        //delete post
        $blogs->delete();

        return redirect('/admin/blog');
    }


}
