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
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'title'     => 'required',
            'description'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/learning-resource', $image->hashName());

        Learning::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description
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
        $this->validate($request, [
            'image'     => 'mimes:jpeg,jpg,png',
            'title'     => 'string',
            'description'   => 'string'
        ]);

        //get post by ID
        $learnings = Learning::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/learning-resource', $image->hashName());

            //delete old image
            Storage::delete('public/learning-resource/'.$learnings->image);

            //update post with new image
            $learnings->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'description'   => $request->description
            ]);

        } else {

            //update post without image
            $learnings->update([
                'title'     => $request->title,
                'description'   => $request->description
            ]);
        }

        return redirect('/admin/learning-resource');
    }

    public function destroy(string $id)
    {
        $learnings = Learning::findOrFail($id);

        //delete image
        Storage::delete('public/learning-resource/'. $learnings->image);
        //delete learning-resource
        $learnings->delete();
        return redirect('/admin/learning-resource');
    }
}
