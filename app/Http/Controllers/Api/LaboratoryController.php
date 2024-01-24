<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratoryResource;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratories = Laboratory::all();
        return new LaboratoryResource(true, 'List Data Laboratories', $laboratories);
    }

    public function show($slug)
    {
        $laboratories = Laboratory::where('slug', $slug)->first();

        if (!$laboratories) {
            return response()->json(['error' => 'laboratories not found'], 404);
        }

        return response()->json(['data' => $laboratories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string',
            'slug'      => 'required|string|unique:laboratories',
            'content'   => 'required|string',
            'image'     => 'required|image|mimes:jpeg,png,jpg,pdf',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/laboratories', $image->hashName());

        //create post
        $laboratories = Laboratory::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'slug'          => $request->slug,
            'content'       => $request->content,
        ]);

        //return response
        return new LaboratoryResource(true, 'Data Laboratory Berhasil Ditambahkan!', $laboratories);
    }

    public function update(Request $request, $slug)
    {
        $laboratories = Laboratory::where('slug', $slug)->first();

        if (!$laboratories) {
            return response()->json(['error' => 'laboratories not found'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($laboratories->image) {
                Storage::disk('public')->delete($laboratories->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $laboratories->update($data);

        return response()->json(['data' => $laboratories]);
    }
    public function destroy($slug)
    {
        $laboratories = Laboratory::where('slug', $slug)->first();

        if (!$laboratories) {
            return response()->json(['error' => 'laboratories not found'], 404);
        }

        $laboratories->delete();

        return response()->json(['message' => 'laboratories deleted']);
    }

}
