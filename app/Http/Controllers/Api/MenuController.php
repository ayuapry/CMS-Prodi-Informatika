<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('submenus')->get();
        return new MenuResource(true, 'List Data Menu', $menus);
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
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $menus = Menu::create([
            'name'              => $request->name,
        ]);

        //return response
        return new MenuResource(true, 'Data Menu Berhasil Ditambahkan!', $menus);
    }

    public function show($id)
    {
        $menus = Menu::find($id);
        return new MenuResource(true, 'Detail Data Menu!', $menus);
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
        $menus = Menu::find($id);
    
        // Check if the Riset exists
        if (!$menus) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
    
        $menus->update([
            'name'              => $request->name,
        ]);
    
        // Return response
        return new MenuResource(true, 'Data Menu Berhasil Diupdate!', $menus);
    }

    public function destroy($id)
    {
        $menus = Menu::find($id);

        $menus->delete();

        return new MenuResource(true, 'Data Menu Berhasil Dihapus!', null);
    }

    
}
