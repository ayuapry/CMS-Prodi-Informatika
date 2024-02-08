<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/heroes', App\Http\Controllers\Api\HeroController::class);
Route::apiResource('/learnings', App\Http\Controllers\api\LearningController::class);
Route::apiResource('/our-partners', App\Http\Controllers\api\OurPartnerController::class);
Route::apiResource('/accreditations', App\Http\Controllers\api\AccreditationController::class);
Route::apiResource('/call_to_actions', App\Http\Controllers\api\CallToActionController::class);
Route::apiResource('/blogs', App\Http\Controllers\api\BlogController::class);
Route::apiResource('/laboratories', App\Http\Controllers\api\LaboratoryController::class);
Route::apiResource('/teaching-staff', App\Http\Controllers\api\TeachingStaffController::class);
Route::apiResource('/achievments', App\Http\Controllers\api\AchievmentController::class);
Route::apiResource('/organizations', App\Http\Controllers\api\OrganizationController::class);
Route::apiResource('/about-us', App\Http\Controllers\api\AboutUsController::class);
Route::apiResource('/downloads', App\Http\Controllers\api\DownloadController::class);
Route::apiResource('/risets', App\Http\Controllers\api\RisetController::class);
Route::apiResource('/menus', App\Http\Controllers\api\MenuController::class);
Route::apiResource('/sub-menus', App\Http\Controllers\api\SubMenuController::class);

