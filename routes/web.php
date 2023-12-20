<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use  Illuminate\Support\Facades\Auth;

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

// landing page
Route::get('/', function () {
    return view('welcome');
});

// authentication routes - php artisan make:auth generates it
Auth::routes();


/* // group the following routes by auth middleware - you have to be signed-in to proceeed
 Route::group(['middleware' => 'auth'], function() {
	// Dashboard
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
	Route::get('admin/dashboard', [HomeController::class, 'Adminindex'])->name('home.admin');


    Route::get('users/profile', [ProfileController::class,'editt'])->name('users.edit-profile');
    Route::put('users/profile', [ProfileController::class,'update'])->name('users.update-profile');
	// Posts resourcfull controllers routes
	Route::resource('posts', PostController::class);

	// Comments routes
	Route::group(['prefix' => '/comments', 'as' => 'comments.'], function() {
        // store comment route
		Route::post('/{post}',[CommentController::class,'store'])->name('store');
	});

	// Replies routes
	Route::group(['prefix' => '/replies', 'as' => 'replies.'], function() {
        // store reply route
		Route::post('/{comment}', [ReplyController::class,'store'])->name('store');
	});
});
Auth::routes(); */

 Route::middleware(['auth','user-role:admin'])->group(function(){

	Route::get('admin/dashboard', [HomeController::class, 'Adminindex'])->name('home.admin');
    Route::get('admin/delete/{id}',[PostController::class , 'destroy']);

    Route::get('admin/users/profile', [ProfileController::class,'editt'])->name('admin.users.edit-profile');
    Route::put('admin/users/profile', [ProfileController::class,'update'])->name('admin.users.update-profile');


    Route::get('admin/allusers/profile', [ProfileController::class,'showAllUsers'])->name('allusers.edit.account');
    Route::get('admin/allusers/delete/{id}', [ProfileController::class,'deleteTheUser'])->name('allusers.delete');
    Route::get('admin/allusers/edit/profile/{id}', [ProfileController::class,'edittAllInformation'])->name('admin.allusers.edit-profile');
    Route::put('admin/allusers/edit/profile/{id}', [ProfileController::class,'updateAllIformations'])->name('admin.allusers.update-profile');

}

);

Route::middleware(['auth'])->group(function(){


	Route::resource('posts', PostController::class);
	// Comments routes
	Route::group(['prefix' => '/comments', 'as' => 'comments.'], function() {
        // store comment route
		Route::post('/{post}',[CommentController::class,'store'])->name('store');
	});

	// Replies routes
	Route::group(['prefix' => '/replies', 'as' => 'replies.'], function() {
        // store reply route
		Route::post('/{comment}', [ReplyController::class,'store'])->name('store');
	});
});


Route::middleware(['auth','user-role:user'])->group(function(){

    // Dashboard
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('delete/{id}',[PostController::class , 'destroyForUser']);
    Route::get('users/profile', [ProfileController::class,'editt'])->name('users.edit-profile');
    Route::put('users/profile', [ProfileController::class,'update'])->name('users.update-profile');

}
);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
