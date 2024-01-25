<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\TeachingStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeachingStaffController extends Controller
{
    public function index()
    {
        $teaching_staff = TeachingStaff::all();
        return view("admin.teaching-staff.index", ["teaching_staff" => $teaching_staff]);
    }

    public function create()
    {
        return view("admin.teaching-staff.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png',
            'title'         => 'required',
            'description'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/teaching-staff', $image->hashName());

        TeachingStaff::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect('/admin/teaching-staff');
    }

    public function show(string $id)
    {
        $teaching_staff = TeachingStaff::findOrFail($id);
        return view('admin.teaching-staff.edit', ['teaching_staff' => $teaching_staff]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png',
            'title'     => 'string',
            'description'   => 'string'
        ]);

        //get post by ID
        $teaching_staff = TeachingStaff::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/teaching-staff', $image->hashName());

            //delete old image
            Storage::delete('public/teaching-staff/'.$teaching_staff->image);

            //update post with new image
            $teaching_staff->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //update post without image
            $teaching_staff->update([
                'title'     => $request->title,
                'description'   => $request->description
            ]);
        }

        return redirect('/admin/teaching-staff');
    }

    public function destroy(string $id)
    {
        $teaching_staff = TeachingStaff::findOrFail($id);

        //delete image
        Storage::delete('public/teaching-staff/'. $teaching_staff->image);
        //delete teaching-staff
        $teaching_staff->delete();
        return redirect('/admin/teaching-staff');
    }
}
