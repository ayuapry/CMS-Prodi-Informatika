<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $about_us = AboutUs::all();
        return view("admin.about-us.index", ["about_us" => $about_us]);
    }

    public function create()
    {
        return view("admin.about-us.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,png,jpg,pdf',
            'title'         => 'required',
            'description'   => 'required',
            'selayang'      => 'required',
            'vision'        => 'required',
            'mision'        => 'required',
            'content'       => '',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/about-us', $image->hashName());

        AboutUs::create([
            'image'          => $image->hashName(),
            'title'          => $request->title,
            'description'    => $request->description,
            'selayang'       => $request->selayang,
            'vision'         => $request->vision,
            'mision'         => $request->mision,
            'content'        => $request->content,
        ]);


        return redirect('/admin/about-us');
    }

    public function show(string $id)
    {
        $about_us = AboutUs::findOrFail($id);
        return view('admin.about-us.edit', ['about_us' => $about_us]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'         => 'image|mimes:jpeg,png,jpg,pdf',
            'title'         => 'string',
            'description'   => 'string',
            'selayang'      => 'string',
            'vision'        => 'string',
            'mision'        => 'string',
            'content'       => '',
        ]);

        //get post by ID
        $about_us = AboutUs::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/about_us', $image->hashName());

            //delete old image
            Storage::delete('public/about_us/'.$about_us->image);

            //update post with new image
            $about_us->update([
                'image'          => $image->hashName(),
                'title'          => $request->title,
                'description'    => $request->description,
                'selayang'       => $request->selayang,
                'vision'         => $request->vision,
                'mision'         => $request->mision,
                'content'        => $request->content,
            ]);

        } else {
            //update post without image
            $about_us->update([
                'title'          => $request->title,
                'description'    => $request->description,
                'selayang'       => $request->selayang,
                'vision'         => $request->vision,
                'mision'         => $request->mision,
                'content'        => $request->content,
            ]);
        }

        return redirect('/admin/about-us');
    }

    public function destroy(string $id)
    {
        $about_us = AboutUs::findOrFail($id);

        //delete image
        Storage::delete('public/about-us/'. $about_us->image);

        //delete post
        $about_us->delete();

        return redirect('/admin/about-us');
    }

}
