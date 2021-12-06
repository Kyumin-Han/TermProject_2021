<?php

use App\Http\Controllers\CarInfoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Models\Location;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard', ['locations'=>Location::all()]);
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->post('/home', [HomeController::class, 'getloc']);

Route::middleware(['auth:sanctum', 'verified'])->get('/mycar', [CarInfoController::class, 'inputinfo'])->name('mycar');

Route::middleware(['auth:sanctum', 'verified'])->post('/storecarinfo', [CarInfoController::class, 'store'])->name('storecarinfo');

Route::middleware(['auth:sanctum', 'verified'])->get('/showcarinfo', [CarInfoController::class, 'show'])->name('showcarinfo');
                                        
Route::middleware(['auth:sanctum', 'verified'])->delete('/deletecar/{id}', [CarInfoController::class, 'delete'])->name('deletecar');




