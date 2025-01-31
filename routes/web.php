<?php

use App\Http\Controllers\ProfileController;
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


//Old code 
/*Route::get('/', function () {
    return redirect("/dashboard");
});*/

Route::get(
    '/',
    [DashboardController::class, "index"]
)->middleware([/*'auth',*/'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard.vue');
})/*->middleware(['auth','verified'])*/->name('Dashboard');

// Route::get('/readonly', function () {
//     return Inertia::render('Readonly');
// })->name('readonly');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
