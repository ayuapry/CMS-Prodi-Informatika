<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CallToAction;
use Illuminate\Http\Request;

class CallToActionController extends Controller
{
    public function index()
    {
        $call_to_actions = CallToAction::all();
        return view("admin.call-to-action.index", ["call_to_actions" => $call_to_actions]);
    }

    public function create()
    {
        return view("admin.call-to-action.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => '',
            'buttonText'    => 'required',
            'url'           => 'required'
        ]);

        CallToAction::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'buttonText'    => $request->buttonText,
            'url'           => $request->url
        ]);


        return redirect('/admin/call-to-action');
    }

    public function show(string $id)
    {
        $call_to_actions = CallToAction::findOrFail($id);
        return view('admin.call-to-action.edit', ['call_to_actions' => $call_to_actions]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description'   => '',
            'buttonText'    => 'required',
            'url'           => 'required'
        ]);

        $call_to_action = CallToAction::find($id);

        if (!$call_to_action) {
            // CallToAction not found, you can customize the response accordingly
            return redirect('/admin/call-to-action')->with('error', 'CallToAction not found');
        }

        $call_to_action->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'buttonText'    => $request->buttonText,
            'url'           => $request->url
        ]);

        return redirect('/admin/call-to-action')->with('success', 'CallToAction updated successfully');
    }

    public function destroy(string $id)
    {
        $call_to_actions = CallToAction::findOrFail($id);

        //delete post
        $call_to_actions->delete();

        return redirect('/admin/call-to-action');
    }

}
