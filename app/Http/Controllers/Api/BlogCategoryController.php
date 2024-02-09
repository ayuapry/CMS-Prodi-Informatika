<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $blogcategories = BlogCategory::with('blogs')->get();
        return new BlogCategoryResource(true, 'List Data Blog Category', $blogcategories);
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
            'name' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $blogcategories = BlogCategory::create([
            'name' => $request->name,
        ]);

        //return response
        return new BlogCategoryResource(true, 'Data Blog Category Berhasil Ditambahkan!', $blogcategories);
    }

    public function show($id)
    {
        $blogcategories = BlogCategory::find($id);
        return new BlogCategoryResource(true, 'Detail Data Blog Category!', $blogcategories);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Find the Riset by ID
        $blogcategories = BlogCategory::find($id);
    
        // Check if the Riset exists
        if (!$blogcategories) {
            return response()->json(['error' => 'Blog Category not found'], 404);
        }
    
        $blogcategories->update([
            'name' => $request->name,
        ]);
    
        // Return response
        return new BlogCategoryResource(true, 'Data Blog Category Berhasil Diupdate!', $blogcategories);
    }

    public function destroy($id)
    {
        $blogcategories = BlogCategory::find($id);

        $blogcategories->delete();

        return new BlogCategoryResource(true, 'Data Blog Category Berhasil Dihapus!', null);
    }
  
}
