<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    */
   public function index()
   {
       $blogcategories = BlogCategory::all();
       return view("admin.blog-category.index", ["blogcategories" => $blogcategories]);
   }

    /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       return view("admin.blog-category.add");
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
           "name" => "required",
       ]);

       BlogCategory::create([
           "name" => $validated["name"],
       ]);

       return redirect('/admin/blog-category');
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
       $blogcategories = BlogCategory::findOrFail($id);
       return view("admin.blog-category.edit", ["blogcategories" => $blogcategories]);
   }

   public function update(Request $request, string $id)
   {
       $validated = $request->validate([
           'name' => 'required',
       ]);

       BlogCategory::where('id', $id)->update([
           'name' => $validated['name'],
       ]);

       return redirect('/admin/blog-category');
   }

   public function destroy(string $id)
   {
       BlogCategory::destroy($id);
       return redirect('/admin/blog-category');
   }

}
