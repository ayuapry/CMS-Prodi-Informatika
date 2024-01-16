<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CallToActionResource;
use App\Models\CallToAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CallToActionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $call_to_actions = CallToAction::latest()->paginate(5);

        //return collection of call$call_to_action as a resource
        return new CallToActionResource(true, 'List Data call to action', $call_to_actions);
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
            'buttonText'    => 'required',
            'url'           => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $call_to_actions = CallToAction::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'buttonText'    => $request->buttonText,
            'url'           => $request->url
        ]);

        //return response
        return new CallToActionResource(true, 'Data CTA Berhasil Ditambahkan!', $call_to_actions);
    }

    public function show($id)
    {
        $call_to_actions = CallToAction::find($id);
        return new CallToActionResource(true, 'Detail Data CTA!', $call_to_actions);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => '',
            'buttonText'    => 'required',
            'url'           => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Find the CallToAction by ID
        $call_to_action = CallToAction::find($id);
    
        // Check if the CallToAction exists
        if (!$call_to_action) {
            return response()->json(['error' => 'CallToAction not found'], 404);
        }
    
        // Update CallToAction attributes
        // $call_to_action->title = $request->title;
        // $call_to_action->description = $request->description;
        // $call_to_action->buttonText = $request->buttonText;
        // $call_to_action->url = $request->url;
        $call_to_action->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'buttonText'    => $request->buttonText,
            'url'           => $request->url
        ]);
    
        // Save the updated CallToAction
        // $call_to_action->save();
    
        // Return response
        return new CallToActionResource(true, 'Data CTA Berhasil Diupdate!', $call_to_action);
    }

    public function destroy($id)
    {
        $call_to_action = CallToAction::find($id);

        $call_to_action->delete();

        return new CallToActionResource(true, 'Data CTA Berhasil Dihapus!', null);
    }
    

}
