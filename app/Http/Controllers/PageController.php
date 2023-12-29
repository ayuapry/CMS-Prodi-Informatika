<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function adminDashboard()
    {
        return view("admin.dashboard");
    }
}
