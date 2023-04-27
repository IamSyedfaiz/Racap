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

Route::post('/add_client', [ManagementController::class, 'add_client'])->name('add_client');
Route::post('/add_project', [ManagementController::class, 'add_project'])->name('add_project');
Route::post('/add_product', [ManagementController::class, 'add_product'])->name('add_product');
Route::post('/add_client_project', [ManagementController::class, 'add_client_project'])->name('add_client_project');
Route::post('/add_consultant_project', [ManagementController::class, 'add_consultant_project'])->name('add_consultant_project');

Route::get('/current-Projects', [AdminController::class, 'currentprojects'])->name('currentprojects');
Route::get('/project-details/{id}', [AdminController::class, 'project_details'])->name('project.details');
Route::get('/view-files/{id}', [AdminController::class, 'view_files'])->name('view.files');
Route::post('/upload_file', [AdminController::class, 'upload_file'])->name('upload.file');

Route::get('/view-account/{id}', [AdminController::class, 'view_account'])->name('view.account');
Route::get('/view-trash/{id}', [AdminController::class, 'view_trash'])->name('view.trash');
Route::post('/add_account', [AdminController::class, 'add_account'])->name('add.account');
Route::get('/file-Delete/{id}', [AdminController::class, 'fileDelete'])->name('fileDelete');
Route::get('/restore_file/{id}', [AdminController::class, 'restore_file'])->name('restore.file');
Route::get('/final_delete/{id}', [AdminController::class, 'final_delete'])->name('final.delete');
Route::get('/past_projects', [AdminController::class, 'pastprojects'])->name('past.projects');
Route::get('/upcoming_projects', [AdminController::class, 'upcomingproject'])->name('upcoming.project');
Route::get('/product_delete/{id}', [AdminController::class, 'productdelete'])->name('product.delete');
Route::get('/add_subadmin', [AdminController::class, 'addsubadmin'])->name('add.subadmin');
Route::post('/add_subadmin', [AdminController::class, 'add_subadmin'])->name('add.subadmin');

Route::post('/message-send', [MessageController::class, 'message_send'])->name('message.send');
Route::get('/conversation/{id}', [MessageController::class, 'conversation'])->name('conversation');



require __DIR__ . '/auth.php';