<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Riset;
use Illuminate\Http\Request;

class RisetController extends Controller
{
    public function index()
    {
        $risets = Riset::all();
        return view("admin.riset.index", ["risets" => $risets]);
    }

    public function create()
    {
        return view("admin.riset.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'research_title'    => 'required',
            'year'              => 'required',
            'type'              => 'required'
        ]);

        Riset::create([
            'name'              => $request->name,
            'research_title'    => $request->research_title,
            'year'              => $request->year,
            'type'              => $request->type
        ]);


        return redirect('/admin/riset');
    }

    public function show(string $id)
    {
        $risets = Riset::findOrFail($id);
        return view('admin.riset.edit', ['risets' => $risets]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'required',
            'research_title'    => '',
            'year'              => 'required',
            'type'              => 'required'
        ]);

        $call_to_action = Riset::find($id);

        if (!$call_to_action) {
            // Riset not found, you can customize the response accordingly
            return redirect('/admin/riset')->with('error', 'Riset not found');
        }

        $call_to_action->update([
            'name'              => $request->name,
            'research_title'    => $request->research_title,
            'year'              => $request->year,
            'type'              => $request->type
        ]);

        return redirect('/admin/riset')->with('success', 'Riset updated successfully');
    }

    public function destroy(string $id)
    {
        $risets = Riset::findOrFail($id);

        //delete post
        $risets->delete();

        return redirect('/admin/riset');
    }
}
