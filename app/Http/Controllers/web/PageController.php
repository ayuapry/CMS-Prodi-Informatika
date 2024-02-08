<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use App\Models\OurPartner;
use App\Models\TeachingStaff;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function adminDashboard()
    {
        $our_partners = OurPartner::count();
        $teaching_staff = TeachingStaff::count();
        $laboratories = Laboratory::count();
        return view("admin.dashboard", 
            [
                "our_partners" => $our_partners, 
                "teaching_staff" => $teaching_staff,
                "laboratories" => $laboratories
            ]);
    }
}
