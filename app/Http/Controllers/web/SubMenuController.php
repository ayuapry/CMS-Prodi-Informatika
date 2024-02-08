<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    public function index()
    {
        $sub_menus = SubMenu::with("menu")->get();
        return view("admin.sub-menu.index", ["sub_menus" => $sub_menus]);
    }

    public function create()
    {
        $menus = Menu::all();
        return view("admin.sub-menu.add", ["menus" => $menus]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"      => "required",
            "menu_id"   => "required",
        ]);

        // mebnambahkan ke dalam database
        SubMenu::create([
            "name" => $validated["name"],   
            "menu_id" => $validated["menu_id"]     
        ]);

        return redirect('/admin/sub-menu');
    }

    public function show(string $id)
    {
        $sub_menus = SubMenu::with('menu')->findOrFail($id);
        $menus = Menu::all();
        return view('admin.sub-menu.edit', ['sub_menus' => $sub_menus, 'menus' => $menus]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'string',
            'menu_id'           => 'required'
        ]);

        $submenus = SubMenu::find($id);

        if (!$submenus) {
            // Riset not found, you can customize the response accordingly
            return redirect('/admin/sub-menu')->with('error', 'sub-menu not found');
        }

        $submenus->update([
            'name'              => $request->name,
            'menu_id'           => $request->menu_id
        ]);

        return redirect('/admin/sub-menu')->with('success', 'sub-menu updated successfully');
    }

    public function destroy(string $id)
    {
        SubMenu::destroy($id);
        return redirect('/admin/sub-menu');
    }
}
