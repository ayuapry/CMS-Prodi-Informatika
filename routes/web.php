<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\web\HeroController;

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
    }
);