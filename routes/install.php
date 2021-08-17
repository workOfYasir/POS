<?php

/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//todo::installer prefix
Route::group(['namespace'=>'Install','middleware' => 'installCheck','prefix'=>'install'],function (){
    Route::get('/','InstallController@welcome')->name('install');
    Route::get('server/permission','InstallController@permission')->name('permission');
    Route::get('database/create','InstallController@create')->name('create');
    Route::get('database/check','InstallController@checkDbConnencion')->name('check.db');
    Route::post('setup/database','InstallController@dbStore')->name('db.setup');
    Route::get('setup/import/sql','InstallController@importSql')->name('sql.setup');
    Route::get('setup/org/create','InstallController@orgCreate')->name('org.create');
    Route::post('setup/org/store','InstallController@orgSetup')->name('org.setup');
    Route::get('setup/admin','InstallController@adminCreate')->name('admin.create');
    Route::post('setup/admin/store','InstallController@adminStore')->name('admin.store');
});
