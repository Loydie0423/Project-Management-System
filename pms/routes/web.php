<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SampleController;
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
    return view('welcome');
});

Route::get('/signin', [SignInController::class, 'index'])->name('signin.index');
Route::post('/signin/submit', [SignInController::class, 'submit'])->name('signin.submit');
Route::get('/password-reset/send-reset-link', [ResetPasswordController::class, 'index'])->name('password-reset.send-reset-link.index');
Route::get('/password-reset', [ResetPasswordController::class, 'passwordReset'])->name('password-reset.index');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {


        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/datatable/project-summary', [AdminDashboardController::class, 'projectSummaryDataTable'])->name('admin.datatable.projectSummary');
        Route::get('/datatable/task-summary', [AdminDashboardController::class, 'taskSummaryDataTable'])->name('admin.datatable.taskSummary');
        Route::get('/datatable/logs', [AdminDashboardController::class, 'logsDataTable'])->name('admin.datatable.logs');

        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/datatable/category', [CategoryController::class, 'categoryDataTable'])->name('admin.datatable.category');
        Route::get('/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/category/{category}/update', [CategoryController::class, 'update'])->name('admin.category.update');

        Route::get('/project', [ProjectController::class, 'index'])->name('admin.project.index');
        Route::get('/datatable/project', [ProjectController::class, 'projectDataTable'])->name('admin.datatable.project');
        Route::get('/project/add', [ProjectController::class, 'create'])->name('admin.project.create');
        Route::get('/datatable/collaborator/selection', [ProjectController::class, 'collaboratorSelectionDataTable'])->name('admin.datatable.collaborator.selection');
        Route::post('project/generate/{categoryId}/projectCode', [ProjectController::class, 'generateProjectCode'])->name('admin.project.generate.projectCode');
        Route::post('/project/add', [ProjectController::class, 'store'])->name('admin.project.store');
        Route::get('/project/{project}/view', [ProjectController::class, 'show'])->name('admin.project.show');
        Route::get('/datatable/project/{project}/view/task', [ProjectController::class, 'viewProjectTaskDataTable'])->name('admin.datatable.project.show.task');
        Route::get('/datatable/project/{project}/view/collaborators', [ProjectController::class, 'viewProjectCollaboratorsDataTable'])->name('admin.datatable.project.show.collaborators');
        Route::get('/datatable/project/{project}/view/resources', [ProjectController::class, 'viewProjectResourcesDataTable'])->name('admin.datatable.project.show.resources');
    });

    Route::group(['middleware' => 'user'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    });


});

Route::post('/signout', [SignoutController::class, 'signout'])->name('signout');
Route::get('sample', [SampleController::class, 'index'])->name('sample');
