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

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Auth::routes();

Route::get('/home', function(){return redirect()->route("welcome");})->name("home");
Route::get('/contact', function(){return view('contact');})->name("contact");
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])
            ->name('events.index');
Route::get('/events/archive', [App\Http\Controllers\EventController::class, 'archive'])
            ->name('events.archive');
Route::get('/events/me', [App\Http\Controllers\EventController::class, 'myevents'])
            ->name('events.myevents')
            ->middleware('auth');
Route::get('/events/attend/{event}', [App\Http\Controllers\EventController::class, 'attendShow'])
            ->name('events.attendShow');
Route::post('/events/attend/{event}', [App\Http\Controllers\EventController::class, 'attend'])
            ->name('events.attend')
            ->middleware('auth');
Route::get('/events/{id}', [App\Http\Controllers\EventController::class, 'show'])
            ->name('events.show');


Route::get('/user/data/show', [App\Http\Controllers\UserController::class, 'showdata'])
            ->name('userdata.showdata')
            ->middleware('auth');
Route::get('/user/data/delete', [App\Http\Controllers\UserController::class, 'deletedataShow'])
            ->name('userdata.deletedata')
            ->middleware('auth');
Route::post('/user/data/delete', [App\Http\Controllers\UserController::class, 'deletedata'])
            ->name('userdata.delete')
            ->middleware('auth');

Route::get('/admin', function(){return redirect()->route('admin.dashboard');})->middleware(['auth', 'isAdmin']);
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('admin.dashboard')
            ->middleware(['auth', 'isAdmin']);
Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'showUsers'])
            ->name('admin.users')
            ->middleware(['auth', 'isAdmin']);
Route::get('/admin/events', [App\Http\Controllers\AdminController::class, 'showEvents'])
            ->name('admin.events')
            ->middleware(['auth', 'isAdmin']);
Route::get('/admin/events/create', [App\Http\Controllers\AdminController::class, 'createEvent'])
            ->name('admin.events.create')
            ->middleware(['auth', 'isAdmin']);
Route::post('/admin/events/create', [App\Http\Controllers\AdminController::class, 'storeEvent'])
            ->name('admin.events.store')
            ->middleware(['auth', 'isAdmin']);
Route::get('/admin/events/edit/{id}', [App\Http\Controllers\AdminController::class, 'editEvent'])
            ->name('admin.events.edit')
            ->middleware(['auth', 'isAdmin']);
Route::post('/admin/events/update/{id}', [App\Http\Controllers\AdminController::class, 'updateEvent'])
            ->name('admin.events.update')
            ->middleware(['auth', 'isAdmin']);
Route::delete('/admin/events/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteEvent'])
            ->name('admin.events.delete')
            ->middleware(['auth', 'isAdmin']);
Route::post('/admin/events/close/{id}', [App\Http\Controllers\AdminController::class, 'closeEvent'])
            ->name('admin.events.close')
            ->middleware(['auth', 'isAdmin']);
Route::post('/admin/events/open/{id}', [App\Http\Controllers\AdminController::class, 'openEvent'])
            ->name('admin.events.open')
            ->middleware(['auth', 'isAdmin']);
Route::get('/admin/events/{id}', [App\Http\Controllers\AdminController::class, 'showEvent'])
            ->name('admin.events.show')
            ->middleware(['auth', 'isAdmin']);