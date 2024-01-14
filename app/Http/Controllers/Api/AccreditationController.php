<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccreditationResource;
use App\Models\Accreditation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccreditationController extends Controller
{
  /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $accreditations = Accreditation::latest()->paginate(5);

        //return collection of accreditations as a resource
        return new AccreditationResource(true, 'List Data accreditations', $accreditations);
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
        $image->storeAs('public/accreditations', $image->hashName());

        //create post
        $accreditations = Accreditation::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description,
        ]);

        //return response
        return new AccreditationResource(true, 'Data Akreditasi Berhasil Ditambahkan!', $accreditations);
    }

    public function show($id)
    {
        $accreditations = Accreditation::find($id);
        return new AccreditationResource(true, 'Detail Data Accreditation!', $accreditations);
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

        $accreditations = Accreditation::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/accreditations', $image->hashName());

            Storage::delete('public/accreditations/'.basename($accreditations->image));

            $accreditations->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
            ]);
        
        } else {
            $accreditations->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        }

        return new AccreditationResource(true, 'Data Akreditasi Berhasil Diubah', $accreditations);
    }

    public function destroy($id)
    {
        $accreditations = Accreditation::find($id);

        Storage::delete('public/accreditations/'.basename($accreditations->image));

        $accreditations->delete();

        return new AccreditationResource(true, 'Data Akreditasi Berhasil Dihapus!', null);
    }

}
