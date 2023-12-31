<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\OurPartnerResource;
use App\Models\OurPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OurPartnerController extends Controller
{
    public function index()
    {
        //get all posts
        $our_partners = OurPartner::latest()->paginate(5);
        //return collection of heroes as a resource
        return new OurPartnerResource(true, 'List Data Learning Resource', $our_partners);
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
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/our-partner', $image->hashName());

        //create post
        $our_partners = OurPartner::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
        ]);

        //return response
        return new OurPartnerResource(true, 'Data Learning Resource Berhasil Ditambahkan!', $our_partners);
    }

    public function show($id)
    {
        $our_partners = OurPartner::find($id);
        return new OurPartnerResource(true, 'Detail Data Learning Resource!', $our_partners);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $our_partners = OurPartner::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/our-partner', $image->hashName());

            Storage::delete('public/our-partner/'.basename($our_partners->image));

            $our_partners->update([
                'image' => $image->hashName(),
                'title' => $request->title,
            ]);
        
        } else {
            $our_partners->update([
                'title'         => $request->title,
            ]);
        }

        return new OurPartnerResource(true, 'Data Learning Resource Berhasil Diubah', $our_partners);
    }

    public function destroy($id)
    {
        $our_partners = OurPartner::find($id);

        Storage::delete('public/our-partner/'.basename($our_partners->image));

        $our_partners->delete();

        return new OurPartnerResource(true, 'Data Learning Resource Berhasil Dihapus!', null);
    }
}
