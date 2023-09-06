<?php

use App\Http\Controllers\Admin\ActivityLogsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
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
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function() {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('/posts', PostsController::class);
    Route::resource('/books', BooksController::class);

    Route::resource('activitylogs', ActivityLogsController::class)->only(['index', 'show', 'destroy']);
    Route::resource('settings', SettingsController::class);

    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator'])->name('generator');
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

});

require __DIR__.'/auth.php';
