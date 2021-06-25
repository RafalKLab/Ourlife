<?php

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
 * Authorization
 */
Route::get('/signup', [App\Http\Controllers\AuthController::class, 'getSignup'])->middleware('guest')->name('auth.signup');
Route::post('/signup', [App\Http\Controllers\AuthController::class, 'postSignup'])->middleware('guest');

Route::get('/signin', [App\Http\Controllers\AuthController::class, 'getSignin'])->middleware('guest')->name('auth.signin');
Route::post('/signin', [App\Http\Controllers\AuthController::class, 'postSignin'])->middleware('guest');

Route::get('/signout', [App\Http\Controllers\AuthController::class, 'getSignout'])->name('auth.signout');

/**
 *  Search
 */
Route::get('/search', [App\Http\Controllers\SearchController::class, 'getResults'])->name('search.results');

/**
 * Profiles
 */
Route::get('/user/{username}', [App\Http\Controllers\ProfileController::class, 'getProfile'])->name('profile.index');

/**
 * Edit profile
 */
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'getEdit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/edit', [App\Http\Controllers\ProfileController::class, 'postEdit'])->middleware('auth')->name('profile.edit');

/**
 * Friends
 */
Route::get('/friends', [App\Http\Controllers\FriendController::class, 'getIndex'])->middleware('auth')->name('friend.index');
Route::get('/friends/add/{username}', [App\Http\Controllers\FriendController::class, 'getAdd'])->middleware('auth')->name('friend.add');
Route::get('/friends/accept/{username}', [App\Http\Controllers\FriendController::class, 'getAccept'])->middleware('auth')->name('friend.accept');
Route::post('/friends/delete/{username}', [App\Http\Controllers\FriendController::class, 'postDelete'])->middleware('auth')->name('friend.delete');


/**
 * Timeline
 */
Route::post('/status', [App\Http\Controllers\StatusController::class, 'postStatus'])->middleware('auth')->name('status.post');
Route::post('/status/{statusId}/reply', [App\Http\Controllers\StatusController::class, 'postReply'])->middleware('auth')->name('status.reply');
Route::post('/status/delete/{id}', [App\Http\Controllers\StatusController::class, 'destroy'])->middleware('auth')->name('status.destroy');
Route::get('/status/{statusId}/like', [App\Http\Controllers\StatusController::class, 'getLike'])->middleware('auth')->name('status.like');


/**
 * Events
 */
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->middleware('auth')->name('events.get');
Route::get('/events/create', [App\Http\Controllers\EventController::class, 'create'])->middleware('auth')->name('events.create');
Route::post('/events/create', [App\Http\Controllers\EventController::class, 'store'])->middleware('auth');
Route::post('/events/delete/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->middleware('auth')->name('EventDelete');


/**
 * Admin
 */
Route::group(['middleware' => ['role:Admin']], function () {
    Route::view('/admin', 'admin.home')->name('Admin');
    //users controll
    Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('Admin.users');
    Route::get('/admin/users/{id}/edit', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('Admin.users.edit');
    Route::patch('/admin/users/{id}', [App\Http\Controllers\Admin\UsersController::class, 'update']);
    Route::post('/admin/users/{id}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('UserDelete');
    //roles controll
    Route::get('/admin/roles', [App\Http\Controllers\Admin\RolesController::class, 'index'])->name('Admin.roles');
    Route::get('/admin/roles/create', [App\Http\Controllers\Admin\RolesController::class, 'create'])->name('Admin.roles.create');
    Route::post('/admin/roles', [App\Http\Controllers\Admin\RolesController::class, 'store']);
    //posts/statuses
    Route::get('/admin/posts', [App\Http\Controllers\Admin\StatusController::class, 'index'])->name('Admin.posts');
    Route::post('/admin/posts/{id}', [App\Http\Controllers\Admin\StatusController::class, 'destroy'])->name('PostDelete');
});
