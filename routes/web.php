<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\web\AboutUsController;
use App\Http\Controllers\web\AccreditationController;
use App\Http\Controllers\web\AchievmentController;
use App\Http\Controllers\web\BlogController;
use App\Http\Controllers\web\CallToActionController;
use App\Http\Controllers\web\DownloadController;
use App\Http\Controllers\web\HeroController;
use App\Http\Controllers\web\LaboratoryController;
use App\Http\Controllers\web\LearningController;
use App\Http\Controllers\web\OrganizationController;
use App\Http\Controllers\web\OurPartnerController;
use App\Http\Controllers\web\RisetController;
use App\Http\Controllers\web\TeachingStaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//auth
Route::get("/login",  [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::prefix('admin')->middleware(['auth:web'])->group(
    function() {
        Route::get("/dashboard", [PageController::class, "adminDashboard"]);

        //hero
        Route::get("/hero", [HeroController::class, "index"]);
        Route::get("/hero/add", [HeroController::class, "create"]);
        Route::post("/hero", [HeroController::class, "store"]);
        Route::get("/hero/{id}/edit", [HeroController::class, "show"]);
        Route::put("/hero/{id}", [HeroController::class, "update"]);
        Route::get("/hero/{id}/delete", [HeroController::class, "destroy"]);

        //learning-resource
        Route::get("/learning-resource", [LearningController::class, "index"]);
        Route::get("/learning-resource/add", [LearningController::class, "create"]);
        Route::post("/learning-resource", [LearningController::class, "store"]);
        Route::get("/learning-resource/{id}/edit", [LearningController::class, "show"]);
        Route::put("/learning-resource/{id}", [LearningController::class, "update"]);
        Route::get("/learning-resource/{id}/delete", [LearningController::class, "destroy"]);

        //our-partner
        Route::get("/our-partner", [OurPartnerController::class, "index"]);
        Route::get("/our-partner/add", [OurPartnerController::class, "create"]);
        Route::post("/our-partner", [OurPartnerController::class, "store"]);
        Route::get("/our-partner/{id}/edit", [OurPartnerController::class, "show"]);
        Route::put("/our-partner/{id}", [OurPartnerController::class, "update"]);
        Route::get("/our-partner/{id}/delete", [OurPartnerController::class, "destroy"]);

        //Accreditations
        Route::get("/accreditation", [AccreditationController::class, "index"]);
        Route::get("/accreditation/add", [AccreditationController::class, "create"]);
        Route::post("/accreditation", [AccreditationController::class, "store"]);
        Route::get("/accreditation/{id}/edit", [AccreditationController::class, "show"]);
        Route::put("/accreditation/{id}", [AccreditationController::class, "update"]);
        Route::get("/accreditation/{id}/delete", [AccreditationController::class, "destroy"]);

        //CallToAction
        Route::get("/call-to-action", [CallToActionController::class, "index"]);
        Route::get("/call-to-action/add", [CallToActionController::class, "create"]);
        Route::post("/call-to-action", [CallToActionController::class, "store"]);
        Route::get("/call-to-action/{id}/edit", [CallToActionController::class, "show"]);
        Route::put("/call-to-action/{id}", [CallToActionController::class, "update"]);
        Route::get("/call-to-action/{id}/delete", [CallToActionController::class, "destroy"]);

        //CallToAction
        Route::get("/blog", [BlogController::class, "index"]);
        Route::get("/blog/add", [BlogController::class, "create"]);
        Route::post("/blog", [BlogController::class, "store"]);
        Route::get("/blog/{id}/edit", [BlogController::class, "show"]);
        Route::put("/blog/{id}", [BlogController::class, "update"]);
        Route::get("/blog/{id}/delete", [BlogController::class, "destroy"]);

        //Laboratory
        Route::get("/laboratory", [LaboratoryController::class, "index"]);
        Route::get("/laboratory/add", [LaboratoryController::class, "create"]);
        Route::post("/laboratory", [LaboratoryController::class, "store"]);
        Route::get("/laboratory/{slug}/edit", [LaboratoryController::class, "show"]);
        Route::put("/laboratory/{id}", [LaboratoryController::class, "update"]);
        Route::get("/laboratory/{slug}/delete", [LaboratoryController::class, "destroy"]);

        //Teaching Staff
        Route::get("/teaching-staff", [TeachingStaffController::class, "index"]);
        Route::get("/teaching-staff/add", [TeachingStaffController::class, "create"]);
        Route::post("/teaching-staff", [TeachingStaffController::class, "store"]);
        Route::get("/teaching-staff/{id}/edit", [TeachingStaffController::class, "show"]);
        Route::put("/teaching-staff/{id}", [TeachingStaffController::class, "update"]);
        Route::get("/teaching-staff/{id}/delete", [TeachingStaffController::class, "destroy"]);

        //Achievment
        Route::get("/achievment", [AchievmentController::class, "index"]);
        Route::get("/achievment/add", [AchievmentController::class, "create"]);
        Route::post("/achievment", [AchievmentController::class, "store"]);
        Route::get("/achievment/{id}/edit", [AchievmentController::class, "show"]);
        Route::put("/achievment/{id}", [AchievmentController::class, "update"]);
        Route::get("/achievment/{id}/delete", [AchievmentController::class, "destroy"]);

        //Organization
        Route::get("/organization", [OrganizationController::class, "index"]);
        Route::get("/organization/add", [OrganizationController::class, "create"]);
        Route::post("/organization", [OrganizationController::class, "store"]);
        Route::get("/organization/{id}/edit", [OrganizationController::class, "show"]);
        Route::put("/organization/{id}", [OrganizationController::class, "update"]);
        Route::get("/organization/{id}/delete", [OrganizationController::class, "destroy"]);

        //About Us
        Route::get("/about-us", [AboutUsController::class, "index"]);
        Route::get("/about-us/add", [AboutUsController::class, "create"]);
        Route::post("/about-us", [AboutUsController::class, "store"]);
        Route::get("/about-us/{id}/edit", [AboutUsController::class, "show"]);
        Route::put("/about-us/{id}", [AboutUsController::class, "update"]);
        Route::get("/about-us/{id}/delete", [AboutUsController::class, "destroy"]);

        //Download
        Route::get("/download", [DownloadController::class, "index"]);
        Route::get("/download/add", [DownloadController::class, "create"]);
        Route::post("/download", [DownloadController::class, "store"]);
        Route::get("/download/{id}/edit", [DownloadController::class, "show"]);
        Route::put("/download/{id}", [DownloadController::class, "update"]);
        Route::get("/download/{id}/delete", [DownloadController::class, "destroy"]);

        //Download
        Route::get("/riset", [RisetController::class, "index"]);
        Route::get("/riset/add", [RisetController::class, "create"]);
        Route::post("/riset", [RisetController::class, "store"]);
        Route::get("/riset/{id}/edit", [RisetController::class, "show"]);
        Route::put("/riset/{id}", [RisetController::class, "update"]);
        Route::get("/riset/{id}/delete", [RisetController::class, "destroy"]);
    }
);