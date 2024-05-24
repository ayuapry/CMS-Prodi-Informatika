<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RisetResource;
use App\Models\Riset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RisetController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $risets = Riset::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('research_title', 'LIKE', "%{$query}%")
            ->orWhere('year', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(10);

        return new RisetResource(true, 'List Data Riset', $risets);
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
            'name'              => 'required',
            'research_title'    => 'required',
            'year'              => 'required',
            'type'              => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $risets = Riset::create([
            'name'              => $request->name,
            'research_title'    => $request->research_title,
            'year'              => $request->year,
            'type'              => $request->type
        ]);

        //return response
        return new RisetResource(true, 'Data Riset Berhasil Ditambahkan!', $risets);
    }

    public function show($id)
    {
        $risets = Riset::find($id);
        return new RisetResource(true, 'Detail Data Riset!', $risets);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'string',
            'research_title'    => 'string',
            'year'              => 'string',
            'type'              => 'string'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Find the Riset by ID
        $risets = Riset::find($id);
    
        // Check if the Riset exists
        if (!$risets) {
            return response()->json(['error' => 'Riset not found'], 404);
        }
    
        $risets->update([
            'name'              => $request->name,
            'research_title'    => $request->research_title,
            'year'              => $request->year,
            'type'              => $request->type
        ]);
    
        // Return response
        return new RisetResource(true, 'Data Riset Berhasil Diupdate!', $risets);
    }

    public function destroy($id)
    {
        $risets = Riset::find($id);

        $risets->delete();

        return new RisetResource(true, 'Data Riset Berhasil Dihapus!', null);
    }
}