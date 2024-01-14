<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccreditationController extends Controller
{
    public function index()
    {
        $accreditations = Accreditation::all();
        return view("admin.accreditation.index", ["accreditations" => $accreditations]);
    }

    public function create()
    {
        return view("admin.accreditation.add");
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
        $image->storeAs('public/accreditations', $image->hashName());

        Accreditation::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description
        ]);


        return redirect('/admin/accreditation');
    }

    public function show(string $id)
    {
        $accreditations = Accreditation::findOrFail($id);
        return view('admin.accreditation.edit', ['accreditation' => $accreditations]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png,pdf',
            'title'     => 'string',
            'description'   => 'string'
        ]);

        //get post by ID
        $accreditations = Accreditation::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/accreditations', $image->hashName());

            //delete old image
            Storage::delete('public/accreditations/'.$accreditations->image);

            //update post with new image
            $accreditations->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //update post without image
            $accreditations->update([
                'title'     => $request->title,
                'description'   => $request->description
            ]);
        }

        return redirect('/admin/accreditation');
    }

    public function destroy(string $id)
    {
        $accreditations = Accreditation::findOrFail($id);

        //delete image
        Storage::delete('public/accreditations/'. $accreditations->image);

        //delete post
        $accreditations->delete();

        return redirect('/admin/accreditation');
    }

}
