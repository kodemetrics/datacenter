<?php

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

Route::post('/','LoginController@index');  
Route::get('/dashboard','DaccessController@showDasboard');
Route::get('/requestaccess','DaccessController@showRequestaccess');
Route::get('/requestaccess/delete/{id}','DaccessController@deleteRequest');
Route::get('/allrequest','DaccessController@showAllrequest');
Route::get('/settings','DaccessController@showSettings');

Route::get('/adddatacenter','DaccessController@showAdddatacenter');
Route::get('/addrole','DaccessController@showAddrole');
Route::get('/addapprovemgr','DaccessController@showAddapprovemgr');

Route::post('/requestaccess','DaccessController@storeRequestaccess');
Route::post('/adddatacenter','DaccessController@storeAdddatacenter');
Route::post('/addrole','DaccessController@storeAddrole');
Route::post('/addapprovemgr','DaccessController@storeAddapprovemgr');


