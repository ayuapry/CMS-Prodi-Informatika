<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view("admin.menu.index", ["menus" => $menus]);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.menu.add");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
        ]);

        Menu::create([
            "name" => $validated["name"],
        ]);

        return redirect('/admin/menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menus = Menu::findOrFail($id);
        return view("admin.menu.edit", ["menus" => $menus]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Menu::where('id', $id)->update([
            'name' => $validated['name'],
        ]);

        return redirect('/admin/menu');
    }

    public function destroy(string $id)
    {
        Menu::destroy($id);
        return redirect('/admin/menu');
    }

}
