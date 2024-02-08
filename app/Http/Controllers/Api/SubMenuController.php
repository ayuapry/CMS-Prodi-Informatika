<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubMenuResource;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    public function index()
    {
        $submenus = SubMenu::all();
        return new SubMenuResource(true, 'List Data SubMenu', $submenus);
    }

    


}
