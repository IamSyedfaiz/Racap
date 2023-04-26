<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/create_teams', [Controller::class, 'create_teams'])->name('create_teams');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::post('/add_client', [ManagementController::class, 'add_client']);
Route::post('/add_project', [ManagementController::class, 'add_project']);
Route::post('/add_product', [ManagementController::class, 'add_product']);
Route::post('/add_client_project', [ManagementController::class, 'add_client_project']);
Route::post('/add_consultant_project', [ManagementController::class, 'add_consultant_project']);

Route::get('/current-Projects', [AdminController::class, 'currentprojects']);
Route::get('/project-details/{id}', [AdminController::class, 'project_details']);
Route::get('/view-files/{id}', [AdminController::class, 'view_files']);
Route::post('/upload_file', [AdminController::class, 'upload_file']);

Route::get('/view-account/{id}', [AdminController::class, 'view_account']);
Route::get('/view-trash/{id}', [AdminController::class, 'view_trash']);
Route::post('/add_account', [AdminController::class, 'add_account']);
Route::get('/destroy/{id}', [AdminController::class, 'destroy']);
Route::get('/restore_file/{id}', [AdminController::class, 'restore_file']);
Route::get('/final_delete/{id}', [AdminController::class, 'final_delete']);
Route::get('/past_projects', [AdminController::class, 'pastprojects']);
Route::get('/upcoming_projects', [AdminController::class, 'upcomingproject']);
Route::get('/product_delete/{id}', [AdminController::class, 'productdelete']);
Route::get('/add_subadmin', [AdminController::class, 'addsubadmin']);
Route::post('/add_subadmin', [AdminController::class, 'add_subadmin']);

Route::post('/message-send', [MessageController::class, 'message_send']);
Route::get('/conversation/{id}', [MessageController::class, 'conversation']);



require __DIR__ . '/auth.php';
