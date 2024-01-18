<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\web\AccreditationController;
use App\Http\Controllers\web\BlogController;
use App\Http\Controllers\web\CallToActionController;
use App\Http\Controllers\web\HeroController;
use App\Http\Controllers\web\LearningController;
use App\Http\Controllers\web\OurPartnerController;

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

    }
);