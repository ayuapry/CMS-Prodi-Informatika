<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DownloadResource;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DownloadController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $sortOrder = $request->query('sort', 'DESC');

        //get all posts
        $downloads = Download::query()
        ->where('title', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->orderBy('created_at', $sortOrder)
        ->latest()
        ->paginate(10);

        //return collection of download as a resource
        return new DownloadResource(true, 'List Data Downloads', $downloads);
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
            'title'         => 'required',
            'description'   => '',
            'url'           => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $downloads = Download::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'url'           => $request->url
        ]);

        //return response
        return new DownloadResource(true, 'Data Download Berhasil Ditambahkan!', $downloads);
    }

    public function show($id)
    {
        $downloads = Download::find($id);
        return new DownloadResource(true, 'Detail Data Download!', $downloads);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => '',
            'url'           => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Find the Download by ID
        $downloads = Download::find($id);
    
        // Check if the Download exists
        if (!$downloads) {
            return response()->json(['error' => 'Download not found'], 404);
        }
    
        $downloads->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'url'           => $request->url
        ]);
    
        // Return response
        return new DownloadResource(true, 'Data Download Berhasil Diupdate!', $downloads);
    }

    public function destroy($id)
    {
        $downloads = Download::find($id);

        $downloads->delete();

        return new DownloadResource(true, 'Data Download Berhasil Dihapus!', null);
    }
    

}
