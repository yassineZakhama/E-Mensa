<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WunschgerichtController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\BewertungController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, "index"])->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/gerichte", [MealsController::class, "index"]);
Route::get("/gerichte/{id}", [MealsController::class, "show"]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/wunschgericht", [WunschgerichtController::class, "index"]);
    Route::post("/wunschgericht", [WunschgerichtController::class, "store"]);

    Route::post("/bewertung", [BewertungController::class, "store"]);
    Route::delete("/bewertung/{id}", [BewertungController::class, "destroy"]);
    Route::put("/bewertung/{id}", [BewertungController::class, "highlight"]);

    Route::get("/meinebewertungen", [BewertungController::class, "show"]);
});

require __DIR__.'/auth.php';
