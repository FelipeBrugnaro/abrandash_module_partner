<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\app\Http\Controllers\PartnerController;

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

Route::middleware(['auth.admin', 'page.permission'])->group(function() {

    Route::get('/', 'PartnerController@index')->name('index');
    Route::get('/create', 'PartnerController@create')->name('create');
    Route::get('/edit/{partner}', 'PartnerController@edit')->name('edit');

    Route::post('/create', 'PartnerController@store')->name('store');
    Route::put('/edit/{partner}', 'PartnerController@update')->name('update');
    Route::delete('/delete/{partner}', 'PartnerController@destroy')->name('destroy');
    
});