<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controllers\Frontend\WelcomeController::class, 'index']);
Route::get('/categories', [Controllers\Frontend\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [Controllers\Frontend\CategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [Controllers\Frontend\MenuController::class, 'index'])->name('menus.index');
Route::get('/reservations/step-one', [Controllers\Frontend\ReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservations/step-one', [Controllers\Frontend\ReservationController::class, 'StoreStepOne'])->name('reservations.store.step.one');
Route::get('/reservations/step-two', [Controllers\Frontend\ReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservations/step-two', [Controllers\Frontend\ReservationController::class, 'StoreStepTwo'])->name('reservations.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [\App\Http\Controllers\Admin\Admincontroller::class, 'index'])->name('index');
    Route::resource('/categories', Controllers\Admin\CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', Controllers\Admin\ReservationController::class);


});
require __DIR__ . '/auth.php';
