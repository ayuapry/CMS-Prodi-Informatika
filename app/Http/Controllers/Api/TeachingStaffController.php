<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeachingStaffResource;
use App\Models\TeachingStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeachingStaffController extends Controller
{
    public function index()
    {
        //get all posts
        $teaching_staff = TeachingStaff::latest()->paginate(5);
        //return collection of heroes as a resource
        return new TeachingStaffResource(true, 'List Teaching Staff', $teaching_staff);
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
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/teaching-staff', $image->hashName());

        //create post
        $teaching_staff = TeachingStaff::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        //return response
        return new TeachingStaffResource(true, 'Data Teaching Staff Berhasil Ditambahkan!', $teaching_staff);
    }

    public function show($id)
    {
        $teaching_staff = TeachingStaff::find($id);
        return new TeachingStaffResource(true, 'Detail Teaching Staff!', $teaching_staff);
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

        $teaching_staff = TeachingStaff::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/teaching-staff', $image->hashName());

            Storage::delete('public/teaching-staff/'.basename($teaching_staff->image));

            $teaching_staff->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        
        } else {
            $teaching_staff->update([
                'title'         => $request->title,
                'description'   => $request->description,
            ]);
        }

        return new TeachingStaffResource(true, 'Data Teaching Staff Berhasil Diubah', $teaching_staff);
    }

    public function destroy($id)
    {
        $teaching_staff = TeachingStaff::find($id);

        Storage::delete('public/teaching-staff/'.basename($teaching_staff->image));

        $teaching_staff->delete();

        return new TeachingStaffResource(true, 'Data Teaching Staff Berhasil Dihapus!', null);
    }
}
