<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('homepage');
});

// Login and Logout routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Common authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/Apartments', [AdminController::class, 'Property'])->name('admin.property');
    Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/addproperty', [AdminController::class, 'AddProperty'])->name('admin.addproperty');
    Route::post('/admin/saveproperty', [AdminController::class, 'SaveProperty'])->name('admin.saveproperty');
    Route::delete('/admin/{Property}', [AdminController::class, 'DeleteProperty'])->name('admin.deleteproperty');
    Route::get('/admin/{Property}/edit', [AdminController::class, 'EditProperty'])->name('admin.editproperty');
    Route::put('/admin/{id}/update', [AdminController::class, 'Update'])->name('admin.update');

    // Manage Managers
    Route::get('/admin/aptmanager', [ManagerController::class, 'AddManager'])->name('admin.addmanager');
    Route::post('/admin/savemgr', [ManagerController::class, 'SaveManager'])->name('admin.savemanager');
    Route::get('/admin/managers', [ManagerController::class, 'Managers'])->name('admin.managers');
    Route::get('/admin/edit/{managerid}', [ManagerController::class, 'EditManager'])->name('admin.editmanager');
    Route::put('/admin/update/{managerid}', [ManagerController::class, 'UpdateManager'])->name('admin.updatemanager');
    Route::get('/admin/allocatemgr/{managerid}', [ManagerController::class, 'AllocateManagerForm'])->name('admin.allocatemanager');
    Route::post('/admin/save/{managerid}/{apartmentid}', [ManagerController::class, 'saveAllocateManager'])->name('admin.saveallocatemanager');
    Route::get('/admin/viewManager/{managerid}', [ManagerController::class, 'viewManagement'])->name('admin.ViewManagement');
});

// Manager routes
Route::middleware(['auth:manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'ManagerDashboard'])->name('manager.dashboard');
    // Add other manager routes here
});

// Tenant routes
Route::middleware(['auth:tenant'])->group(function () {
    Route::get('/tenant/dashboard', [TenantController::class, 'TenantDashboard'])->name('tenant.dashboard');
    // Add other tenant routes here
});

// Dashboard route for the common authenticated users (adjust according to your application logic)
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'manager') {
        return redirect()->route('manager.dashboard');
    } elseif ($user->role === 'tenant') {
        return redirect()->route('tenant.dashboard');
    }
    return view('homepage'); // fallback in case of unexpected role
})->middleware(['auth', 'verified'])->name('index');

require __DIR__.'/auth.php';
