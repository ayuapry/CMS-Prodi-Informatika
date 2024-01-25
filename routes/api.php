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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/heroes', App\Http\Controllers\Api\HeroController::class);
Route::apiResource('/learnings', App\Http\Controllers\api\LearningController::class);
Route::apiResource('/our-partners', App\Http\Controllers\api\OurPartnerController::class);
Route::apiResource('/accreditations', App\Http\Controllers\api\AccreditationController::class);
Route::apiResource('/call_to_actions', App\Http\Controllers\api\CallToActionController::class);
Route::apiResource('/blogs', App\Http\Controllers\api\BlogController::class);
Route::apiResource('/laboratories', App\Http\Controllers\api\LaboratoryController::class);
Route::apiResource('/teaching-staff', App\Http\Controllers\api\TeachingStaffController::class);



