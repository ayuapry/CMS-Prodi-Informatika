<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with("blogCategory")->get();
        return view("admin.blog.index", ["blogs" => $blogs]);
    }

    public function create()
    {
        $blogcategories = BlogCategory::all();
        return view("admin.blog.add", ["blogcategories" => $blogcategories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png,pdf',
            'title'     => 'required',
            'description'   => 'required',
            "blogcategory_id" => "required"
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        Blog::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            "blogcategory_id" => $request->blogcategory_id
        ]);


        return redirect('/admin/blog');
    }

    public function show(string $id)
    {
        $blogs = Blog::with('blogcategory')->findOrFail($id);
        $blogcategories = BlogCategory::all();
        return view('admin.blog.edit', ['blog' => $blogs, 'blogcategories' => $blogcategories]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png,pdf',
            'title'     => 'string',
            'description'   => 'string',
            'blogcategory_id' => '',
        ]);

        //get post by ID
        $blogs = Blog::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blog-category', $image->hashName());

            //delete old image
            Storage::delete('public/blog-category/'.$blogs->image);

            //update post with new image
            $blogs->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'blogcategory_id' => $request->blogcategory_id
            ]);

        } else {

            //update post without image
            $blogs->update([
                'title'         => $request->title,
                'description'   => $request->description,
                'blogcategory_id' => $request->blogcategory_id
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
