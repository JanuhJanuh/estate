<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/', function () {
    return view('homepage');
});


Route::get('/dashboard', function () {
    return view('admin/index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//check if user is lognned in and role(protecting the URL)


Route::middleware(['auth', 'role:admin'])->group(function(){

    Route::get('/admin/index', [AdminController::class, 'AdminDashboard'])->name('admin.index');
    Route::get('/admin/Apartments', [AdminController::class, 'Property'])->name('admin.property');
    Route::POST('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/addproperty', [AdminController::class, 'AddProperty'])->name('admin.addproperty');
    Route::POST('/admin/saveproperty', [AdminController::class, 'SaveProperty'])->name('admin.saveproperty');
    Route::delete('/admin/{Property}', [AdminController::class, 'DeleteProperty'])->name('admin.deleteproperty');
    Route::get('/admin/{Property}/edit', [AdminController::class, 'EditProperty'])->name('admin.editproperty');
    Route::put('/admin/{id}/update', [AdminController::class, 'Update'])->name('admin.update');



});
//End Group for Admin Middleware

Route::middleware(['auth', 'role:user'])->group(function(){
Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.user_dashboard');
});
//end user middleware

Route::middleware(['auth', 'role:CareTaker'])->group(function(){
    Route::get('user/dashboard');
    });
