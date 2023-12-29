<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Learning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningController extends Controller
{
    public function index()
    {
        $learnings = Learning::all();
        return view("admin.learning-resource.index", ["learnings" => $learnings]);
    }

    public function create()
    {
        return view("admin.learning-resource.add");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "image" => "required|image|mimes:jpg,jpeg,png",
            "title" => "required",
            "description" => "required"
        ]);

        $saveImage['image'] = Storage::putFile('public/learning-resource', $request->file('image'));

        Learning::create([
            "image" =>  $saveImage["image"],
            "title" => $validated["title"],   
            "description" => $validated["description"]     
        ]);

        return redirect('/admin/learning-resource');
    }

    public function show(string $id)
    {
        $learnings = Learning::findOrFail($id);
        return view('admin.learning-resource.edit', ['learning' => $learnings]);
    }

    public function update(Request $request, string $id)
    {
        $learnings = Learning::findOrFail($id);
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($learnings->image);
            $newImage = ['image' => Storage::putFile('public/learning-resource', $request->file('image'))];
        } else {
            $newImage = ['image' => $learnings-> image];
        }

        Learning::where('id', $id)->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $newImage['image']
        ]);

        return redirect('/admin/learning-resource');
    }

    public function destroy(string $id)
    {
        Learning::destroy($id);
        return redirect('/admin/learning-resource');
    }
}
