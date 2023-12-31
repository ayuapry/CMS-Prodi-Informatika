<?php

namespace App\Http\Controllers\web;
use App\Http\Controllers\Controller;
use App\Models\OurPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurPartnerController extends Controller
{
    public function index()
    {
        $our_partners = OurPartner::all();
        return view("admin.our-partner.index", ["our_partners" => $our_partners]);
    }

    public function create()
    {
        return view("admin.our-partner.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'title'     => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/our-partner', $image->hashName());

        OurPartner::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
        ]);

        return redirect('/admin/our-partner');
    }

    public function show(string $id)
    {
        $our_partners = OurPartner::findOrFail($id);
        return view('admin.our-partner.edit', ['our_partners' => $our_partners]);
    }

    // public function update(Request $request, string $id)
    // {
    //     $this->validate($request, [
    //         'image'     => 'mimes:jpeg,jpg,png',
    //         'title'     => 'string',
    //     ]);

    //     //get post by ID
    //     $our_partners = OurPartner::findOrFail($id);

    //     //check if image is uploaded
    //     if ($request->hasFile('image')) {

    //         //upload new image
    //         $image = $request->file('image');
    //         $image->storeAs('public/our-partner', $image->hashName());

    //         //delete old image
    //         Storage::delete('public/our-partner/'.$our_partners->image);

    //         //update post with new image
    //         $our_partners->update([
    //             'image'     => $image->hashName(),
    //             'title'     => $request->title,
    //         ]);

    //     } else {

    //         //update post without image
    //         $our_partners->update([
    //             'title'     => $request->title,
    //             'description'   => $request->description
    //         ]);
    //     }

    //     return redirect('/admin/our-partner');
    // }

    public function update(Request $request, string $id)
{
    $this->validate($request, [
        'image' => 'mimes:jpeg,jpg,png',
        'title' => 'string',
    ]);

    // get post by ID
    $our_partner = OurPartner::findOrFail($id);

    // check if image is uploaded
    if ($request->hasFile('image')) {
        // upload new image
        $image = $request->file('image');
        $image->storeAs('public/our-partner', $image->hashName());

        // delete old image
        Storage::delete('public/our-partner/'.$our_partner->image);

        // update post with new image
        $our_partner->update([
            'image' => $image->hashName(),
            'title' => $request->title,
        ]);
    } else {
        // update post without image
        $our_partner->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    return redirect('/admin/our-partner');
}


    public function destroy(string $id)
    {
        $our_partners = OurPartner::findOrFail($id);

        //delete image
        Storage::delete('public/our-partner/'. $our_partners->image);
        //delete our-partner
        $our_partners->delete();
        return redirect('/admin/our-partner');
    }
}
