<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
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

$prefixAdmin = 'admin';

// Route::group(['prefix' => $prefixAdmin], function() use($prefixAdmin){
//     Route::name($prefixAdmin .'.')->group(function () {
//         Route::get('login', [LoginController::class, 'showFormLogin'])->name('login.form')->middleware('check.login');
//         Route::post('login', [LoginController::class, 'login'])->name('login');
//         Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//     });
// });


Route::group([
            'prefix' => $prefixAdmin,
            // 'middleware' => ['permission.admin']
], function() use($prefixAdmin){
    Route::name($prefixAdmin .'.')->group(function () {
        
        // DASHBOARD
        // Route::get('dashboard', function () { return view('admin.dashboard');})->name('dashboard');

        //SLIDER
        $slider = 'slider';
        Route::group(['prefix'=> $slider, 'as'=> $slider .'.'], function(){
            Route::any('/', [SliderController::class, 'index'])->name('index');
            Route::any('form', [SliderController::class, 'form'])->name('form'); # phải để any
            Route::post('save', [SliderController::class, 'save'])->name('save');
            Route::post('delete-data', [SliderController::class, 'deleteData'])->name('deleteData');
            Route::post('update-status', [SliderController::class, 'updateStatus'])->name('updateStatus');
            Route::post('update-sequence', [SliderController::class, 'updateSequence'])->name('updateSequence');
        });

        //CATEGORY
        $category = 'category';
        Route::group(['prefix'=> $category, 'as'=> $category .'.'], function(){
            Route::any('/', [CategoryController::class, 'index'])->name('index');
            Route::any('form', [CategoryController::class, 'form'])->name('form');
            Route::post('save', [CategoryController::class, 'save'])->name('save');
            Route::post('delete-data', [CategoryController::class, 'deleteData'])->name('deleteData');
            Route::post('update-status', [CategoryController::class, 'updateStatus'])->name('updateStatus');
            Route::post('update-sequence', [CategoryController::class, 'updateSequence'])->name('updateSequence');
        });

        //SETTING
        $setting = 'setting';
        Route::group(['prefix'=> $setting, 'as'=> $setting .'.'], function(){
            Route::any('/', [SettingController::class, 'index'])->name('index');
            // Route::any('form', [CategoryController::class, 'form'])->name('form');
            // Route::post('save', [CategoryController::class, 'save'])->name('save');
            // Route::post('delete-data', [CategoryController::class, 'deleteData'])->name('deleteData');
            // Route::post('update-status', [CategoryController::class, 'updateStatus'])->name('updateStatus');
            // Route::post('update-sequence', [CategoryController::class, 'updateSequence'])->name('updateSequence');
        });
    });
});