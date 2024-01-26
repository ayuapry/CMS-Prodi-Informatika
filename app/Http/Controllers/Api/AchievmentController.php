<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AchievmentResource;
use App\Models\Achievment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AchievmentController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $achievments = Achievment::latest()->paginate(5);

        //return collection of accreditations as a resource
        return new AchievmentResource(true, 'List Data Blog', $achievments);
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
        $image->storeAs('public/achievments', $image->hashName());

        //create post
        $achievments = Achievment::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
          ]);

        //return response
        return new AchievmentResource(true, 'Data Prestasi Berhasil Ditambahkan!', $achievments);
    }

    public function show($id)
    {
        $achievments = Achievment::find($id);
        return new AchievmentResource(true, 'Detail Data Blog!', $achievments);
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

        $achievments = Achievment::find($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/achievments', $image->hashName());

            Storage::delete('public/achievments/'.basename($achievments->image));

            $achievments->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
              ]);
        
        } else {
            $achievments->update([
                'title'         => $request->title,
                'content'       => $request->content,
              ]);
        }

        return new AchievmentResource(true, 'Data Prestasi Berhasil Diubah', $achievments);
    }

    public function destroy($id)
    {
        $achievments = Achievment::find($id);

        Storage::delete('public/achievments/'.basename($achievments->image));

        $achievments->delete();

        return new AchievmentResource(true, 'Data Prestasi Berhasil Dihapus!', null);
    }
}
