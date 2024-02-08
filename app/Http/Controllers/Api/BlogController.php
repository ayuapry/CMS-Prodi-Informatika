<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $blogs = Blog::latest()->paginate(8);

        //return collection of accreditations as a resource
        return new BlogResource(true, 'List Data Blog', $blogs);
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
            'image'     => 'required|image|mimes:jpeg,png,jpg,pdf',
            'title'     => 'required',
            'description'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        //create post
        $blogs = Blog::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description,
        ]);

        //return response
        return new BlogResource(true, 'Data Blog Berhasil Ditambahkan!', $blogs);
    }

    public function show($id)
    {
        $blogs = Blog::find($id);
        return new BlogResource(true, 'Detail Data Blog!', $blogs);
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

        $blogs = Blog::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());

            Storage::delete('public/blogs/'.basename($blogs->image));

            $blogs->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        
        } else {
            $blogs->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        }

        return new BlogResource(true, 'Data Blog Berhasil Diubah', $blogs);
    }

    public function destroy($id)
    {
        $blogs = Blog::find($id);

        Storage::delete('public/blogs/'.basename($blogs->image));

        $blogs->delete();

        return new BlogResource(true, 'Data Blog Berhasil Dihapus!', null);
    }
}
