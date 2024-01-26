<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view("admin.organization.index", ["organizations" => $organizations]);
    }

    public function create()
    {
        return view("admin.organization.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png,pdf',
            'title'         => 'required',
            'content'       => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/organizations', $image->hashName());

        Organization::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'content'       => $request->content
        ]);


        return redirect('/admin/organization');
    }

    public function show(string $id)
    {
        $organizations = Organization::findOrFail($id);
        return view('admin.organization.edit', ['organization' => $organizations]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'         => 'mimes:jpeg,jpg,png,pdf',
            'title'         => 'string',
            'content'       => 'string'
        ]);

        //get post by ID
        $organizations = Organization::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/organizations', $image->hashName());

            //delete old image
            Storage::delete('public/organizations/'.$organizations->image);

            //update post with new image
            $organizations->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'content'       => $request->content
            ]);

        } else {

            //update post without image
            $organizations->update([
                'title'         => $request->title,
                'content'       => $request->content
            ]);
        }

        return redirect('/admin/organization');
    }

    public function destroy(string $id)
    {
        $organizations = Organization::findOrFail($id);

        //delete image
        Storage::delete('public/organizations/'. $organizations->image);

        //delete post
        $organizations->delete();

        return redirect('/admin/organization');
    }
}
