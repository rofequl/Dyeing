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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('factory', 'Manage\FactoryController');

    Route::resource('buyer', 'Manage\BuyerController');
    Route::get('buyer-list/{buyer}', 'Manage\BuyerController@factoryBuyer')->name('buyer.list');

    Route::resource('style', 'Manage\StyleController');
    Route::get('style-list', 'Manage\StyleController@styleList')->name('style.list');

    Route::resource('colour', 'Manage\ColourController');
    Route::get('colour-list', 'Manage\ColourController@colourList')->name('colour.list');

    Route::resource('order', 'OrderController');
    Route::get('batch-order/{data}', 'OrderController@batchOrder')->name('batch.order');
    Route::get('order-entry', 'OrderController@newOrder')->name('order.entry');
    Route::get('simple-order/{data}', 'OrderController@simpleOrder')->name('simple.order');
    Route::get('grey-order/{data}', 'OrderController@greyOrder')->name('grey.order');

    Route::resource('user', 'UserController');
    Route::put('user-password/{data}', 'UserController@ProfilePassword')->name('user.password');
    Route::get('user-manage', 'UserController@UserManage')->name('UserManage');
    Route::get('/user-delete/{user}', 'Auth\RegisterController@delete')->name('UserDelete');
    Route::post('register', 'Auth\RegisterController@register')->name('register');

    Route::get('order-report', 'ReportController@orderReport')->name('report.order');
    Route::get('stock-report', 'ReportController@stockReport')->name('report.stock');

    Route::resource('batch', 'BatchController');
    Route::get('batch-entry', 'BatchController@newBatch')->name('batch.entry');
    Route::get('get-batch/{data}', 'BatchController@getBatch')->name('batch.get');

    Route::resource('grey', 'GreyController');
    Route::get('grey-entry', 'GreyController@newGrey')->name('grey.entry');
    Route::get('get-grey/{data}', 'GreyController@getGrey')->name('grey.get');

    Route::resource('process', 'Manage\ProcessController');
    Route::resource('process-entry', 'ProcessController');

    Route::resource('finished', 'FinishedController');


});

