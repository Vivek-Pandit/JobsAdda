<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\Jobs\JobsController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\Jobs\JobsController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'jobs'], function () {
    Route::get('single/{id}', [App\Http\Controllers\Jobs\JobsController::class, 'single'])->name('single.job');
    Route::post('save', [App\Http\Controllers\Jobs\JobsController::class, 'saveJob'])->name('save.job');
    Route::post('apply', [App\Http\Controllers\Jobs\JobsController::class, 'jobApply'])->name('apply.job');
    Route::any('search', [App\Http\Controllers\Jobs\JobsController::class, 'search'])->name('search.job');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/single/{name}', [App\Http\Controllers\Categories\CategoryController::class, 'singleCategory'])->name('categories.single');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('profile', [App\Http\Controllers\Users\UserController::class, 'profile'])->name('profile');

    Route::get('applications', [App\Http\Controllers\Users\UserController::class, 'applications'])->name('applications');

    Route::get('savedjobs', [App\Http\Controllers\Users\UserController::class, 'savedJobs'])->name('saved.jobs');

    Route::get('edit-details', [App\Http\Controllers\Users\UserController::class, 'editDetails'])->name('edit.details');
    Route::post('edit-details', [App\Http\Controllers\Users\UserController::class, 'updateDetails'])->name('update.details');

    Route::get('edit-cv', [App\Http\Controllers\Users\UserController::class, 'editCV'])->name('edit.cv');
    Route::post('/edit-cv', [App\Http\Controllers\Users\UserController::class, 'updateCV'])->name('update.cv');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');
    Route::post('/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admin.dashboard');
    Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'admins'])->name('view.admin');
    Route::get('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('create.admin');
    Route::post('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('store.admin');
    Route::get('/display-categories', [App\Http\Controllers\Admins\AdminsController::class, 'displayCategories'])->name('display.categories');
    Route::get('/create-cates', [App\Http\Controllers\Admins\AdminsController::class, 'createCategories'])->name('create.categories');
    Route::post('/create-cates', [App\Http\Controllers\Admins\AdminsController::class, 'storeCategories'])->name('store.categories');

    //update Categories
    Route::get('/edit-cates/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editCategories'])->name('edit.categories');
    Route::post('/edit-cates/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateCategories'])->name('update.categories');


    Route::get('/delete-cates/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCategories'])->name('delete.categories');

    //jobs

    Route::get('/display-jobs', [App\Http\Controllers\Admins\AdminsController::class, 'allJobs'])->name('display.jobs');
    Route::get('/create-jobs', [App\Http\Controllers\Admins\AdminsController::class, 'createJobs'])->name('create.jobs');
    Route::post('/create-jobs', [App\Http\Controllers\Admins\AdminsController::class, 'storeJobs'])->name('store.jobs');


    Route::get('/delete-jobs/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteJobs'])->name('delete.jobs');
    
    Route::get('/display-apps', [App\Http\Controllers\Admins\AdminsController::class, 'displayApplications'])->name('display.applications');
    
    Route::get('/delete-apps/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteApps'])->name('delete.apps');

});
