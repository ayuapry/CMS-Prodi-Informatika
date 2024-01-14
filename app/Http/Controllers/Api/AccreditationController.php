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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        // Handle file upload
        $file = $request->file('file');
        $filePath = $file->storeAs('public/accreditations', $file->hashName());

        // Create accreditation
        $accreditation = Accreditation::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file_path' => $filePath,
        ]);

        return response()->json($accreditation, 201);
    }

    public function index()
    {
        $accreditations = Accreditation::all();

        return new AccreditationResource(true, 'List Data Accreditation', $accreditations);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $accreditations = Accreditation::find($id);

        if ($request->hasFile('file')){
            $file = $request->file('file');
            $file->storeAs('public/accreditations', $file->hashName());

            Storage::delete('public/accreditations/'.basename($accreditations->file));

            $accreditations->update([
                'file_path' => $file->storeAs('public/accreditations', $file->hashName()),
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

        Storage::delete('public/accreditations/'.basename($accreditations->file));

        $accreditations->delete();

        return new AccreditationResource(true, 'Data Akreditasi Berhasil Dihapus!', null);
    }
}
