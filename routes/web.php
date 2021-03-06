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


// Route::post('/', "Auth\LoginController@attemptLogin")->name('login')->middleware('guest');
// Route::get('/', "Auth\LoginController@welcome")->name('welcome')->middleware('guest');
// Route::get('/logout','LoginController@logout');


// Route::group(['middleware' => 'auth'], function() {

Route::post('/mobile','DaccessController@storeMobile');
Route::get('/dashboard','DaccessController@showDasboard');
Route::get('/requestaccess','DaccessController@showRequestaccess');
Route::get('/requestaccess/edit/{id}','DaccessController@editRequest');
Route::get('/requestaccess/delete/{id}','DaccessController@deleteRequest');
Route::get('/requestaccess/approve/{id}','DaccessController@approveRequest');
Route::post('/requestaccess/approve/{id}','DaccessController@storeApprove');
Route::get('/allrequest','DaccessController@showAllrequest');


Route::post('/settings/adddatacenter','SettingsController@addDatacenter');
Route::post('/settings/addrole','SettingsController@addRoles');
Route::post('/settings/addapprovingmgr','SettingsController@addApprovingmgr');
Route::get('/settings','SettingsController@showSettings');
Route::get('/settings/adddatacenter/delete/{id}','SettingsController@deleteDatacenter');
//Route::get('/settings/addrole/delete/{id}','SettingsController@deleteRoles');
Route::get('/settings/trash/delete/{id}','SettingsController@deleteTrash');
Route::get('/settings/addapprovingmgr/delete/{id}','SettingsController@deleteApprovingmgr');
Route::get('/settings/addapprovingmgr/call/','Controller@processCall');

Route::get('/adddatacenter','DaccessController@showAdddatacenter');
Route::get('/addrole','DaccessController@showAddrole');
Route::get('/addapprovemgr','DaccessController@showAddapprovemgr');

Route::post('/requestaccess','DaccessController@storeRequestaccess');
Route::post('/requestaccess/edit/{id}','DaccessController@updateRequest');
Route::post('/adddatacenter','DaccessController@storeAdddatacenter');
Route::post('/addrole','DaccessController@storeAddrole');
Route::post('/addapprovemgr','DaccessController@storeAddapprovemgr');

// });
