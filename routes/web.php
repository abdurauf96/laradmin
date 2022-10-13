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
});

Route::middleware(['auth'])->prefix('admin')->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index');
    Route::resource('roles', 'App\Http\Controllers\Admin\RolesController');
    Route::resource('permissions', 'App\Http\Controllers\Admin\PermissionsController');
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('pages', 'App\Http\Controllers\Admin\PagesController');
    Route::resource('activitylogs', 'App\Http\Controllers\Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', 'App\Http\Controllers\Admin\SettingsController');
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

});

require __DIR__.'/auth.php';
