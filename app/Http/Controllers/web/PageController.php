<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Achievment;
use App\Models\Blog;
use App\Models\Download;
use App\Models\Laboratory;
use App\Models\OurPartner;
use App\Models\Riset;
use App\Models\TeachingStaff;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function adminDashboard()
    {
        $our_partners = OurPartner::count();
        $teaching_staff = TeachingStaff::count();
        $laboratories = Laboratory::count();
        $blogs = Blog::all();
        $achievments = Achievment::count();
        $risets = Riset::count();
        $downloads = Download::count();
        return view("admin.dashboard", 
            [
                "our_partners" => $our_partners, 
                "teaching_staff" => $teaching_staff,
                "laboratories" => $laboratories,
                "blogs" => $blogs,
                "achievments" => $achievments,
                "risets" => $risets,
                "downloads" => $downloads,
            ]);
    }
}
