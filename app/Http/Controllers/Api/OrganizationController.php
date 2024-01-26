<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
    * index
    *
    * @return void
    */
   public function index()
   {
       //get all posts
       $organizations = Organization::latest()->paginate(1);

       //return collection of accreditations as a resource
       return new OrganizationResource(true, 'List Data Organization', $organizations);
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
           'content'       => 'required',
       ]);

       //check if validation fails
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }

       //upload image
       $image = $request->file('image');
       $image->storeAs('public/organizations', $image->hashName());

       //create post
       $organizations = Organization::create([
           'image'     => $image->hashName(),
           'title'     => $request->title,
           'content'   => $request->content,
         ]);

       //return response
       return new OrganizationResource(true, 'Data Organisasi Berhasil Ditambahkan!', $organizations);
   }

   public function show($id)
   {
       $organizations = Organization::find($id);
       return new OrganizationResource(true, 'Detail Data Organisasi!', $organizations);
   }

   public function update(Request $request, $id)
   {
       $validator = Validator::make($request->all(), [
           'title'     => 'required',
           'content'   => 'required',
       ]);

       if ($validator->fails()){
           return response()->json($validator->errors(), 422);
       }

       $organizations = Organization::find($id);

       if ($request->hasFile('image')){
           $image = $request->file('image');
           $image->storeAs('public/organizations', $image->hashName());

           Storage::delete('public/organizations/'.basename($organizations->image));

           $organizations->update([
               'image'     => $image->hashName(),
               'title'     => $request->title,
               'content'   => $request->content,
             ]);
       
       } else {
           $organizations->update([
               'title'         => $request->title,
               'content'       => $request->content,
             ]);
       }

       return new OrganizationResource(true, 'Data Organisasi Berhasil Diubah', $organizations);
   }

   public function destroy($id)
   {
       $organizations = Organization::find($id);

       Storage::delete('public/organizations/'.basename($organizations->image));

       $organizations->delete();

       return new OrganizationResource(true, 'Data Organisasi Berhasil Dihapus!', null);
   }
}