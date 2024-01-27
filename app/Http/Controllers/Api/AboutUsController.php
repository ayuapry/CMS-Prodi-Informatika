<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    /**
    * index
    *
    * @return void
    */
   public function index()
   {
       //get all posts
       $about_us = AboutUs::latest()->paginate(5);

       //return collection of accreditations as a resource
       return new AboutUsResource(true, 'List Data About Us', $about_us);
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
           'image'         => 'required|image|mimes:jpeg,png,jpg,pdf',
           'title'         => 'required',
           'description'   => 'required',
           'selayang'      => 'required',
           'vision'        => 'required',
           'mision'        => 'required',
           'content'       => '',
       ]);

       //check if validation fails
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }

       //upload image
       $image = $request->file('image');
       $image->storeAs('public/about-us', $image->hashName());

       //create post
       $about_us = AboutUs::create([
           'image'          => $image->hashName(),
           'title'          => $request->title,
           'description'    => $request->description,
           'selayang'       => $request->selayang,
           'vision'         => $request->vision,
           'mision'         => $request->mision,
           'content'        => $request->content,
         ]);

       //return response
       return new AboutUsResource(true, 'Data About Us Berhasil Ditambahkan!', $about_us);
   }

   public function show($id)
   {
       $about_us = AboutUs::find($id);
       return new AboutUsResource(true, 'Detail About-Us!', $about_us);
   }

   public function update(Request $request, $id)
   {
       $validator = Validator::make($request->all(), [
        'title'         => '',
        'description'   => '',
        'selayang'      => '',
        'vision'        => '',
        'mision'        => '',
        'content'       => '',
       ]);

       if ($validator->fails()){
           return response()->json($validator->errors(), 422);
       }

       $about_us = AboutUs::find($id);

       if ($request->hasFile('image')){
           $image = $request->file('image');
           $image->storeAs('public/about-us', $image->hashName());

           Storage::delete('public/about-us/'.basename($about_us->image));

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
           $about_us->update([
               'title'          => $request->title,
               'description'    => $request->description,
               'selayang'       => $request->selayang,
               'vision'         => $request->vision,
               'mision'         => $request->mision,
               'content'        => $request->content,
             ]);
       }

       return new AboutUsResource(true, 'Data Tentang Kami Berhasil Diubah', $about_us);
   }

   public function destroy($id)
   {
       $about_us = AboutUs::find($id);

       Storage::delete('public/about-us/'.basename($about_us->image));

       $about_us->delete();

       return new AboutUsResource(true, 'Data AboutUs Berhasil Dihapus!', null);
   }
}