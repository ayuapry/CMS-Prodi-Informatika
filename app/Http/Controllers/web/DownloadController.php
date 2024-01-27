<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::all();
        return view("admin.download.index", ["downloads" => $downloads]);
    }

    public function create()
    {
        return view("admin.download.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => '',
            'url'           => 'required'
        ]);

        Download::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'url'           => $request->url
        ]);


        return redirect('/admin/download');
    }

    public function show(string $id)
    {
        $downloads = Download::findOrFail($id);
        return view('admin.download.edit', ['downloads' => $downloads]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => '',
            'url'           => 'required'
        ]);

        $downloads = Download::find($id);

        if (!$downloads) {
            // CallToAction not found, you can customize the response accordingly
            return redirect('/admin/download')->with('error', 'CallToAction not found');
        }

        $downloads->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'url'           => $request->url
        ]);

        return redirect('/admin/download')->with('success', 'Download updated successfully');
    }

    public function destroy(string $id)
    {
        $downloads = Download::findOrFail($id);

        //delete post
        $downloads->delete();

        return redirect('/admin/download');
    }

}