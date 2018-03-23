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

Auth::routes();

Route::get('/settings', 'HomeController@settings')->name('settings');
Route::post('/settings', 'HomeController@update')->name('saveSettings');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/history', 'HomeController@historyList')->name('history');
Route::get('/groups', 'GroupController@getList')->name('groups');
Route::get('/new-group', 'GroupController@getNew')->name('new-group');
Route::post('/new-group', 'GroupController@postNew')->name('new-group');
Route::get('/group/{id}/details', 'GroupController@getDetails')->name('group-details');
Route::get('/group/{id}/restaurants', 'GroupController@getRestaurants')->name('group-restaurants');
Route::get('/group/{id}/settings', 'GroupController@getSettings')->name('group-settings');
Route::get('/group/{id}/members', 'GroupController@getMembers')->name('group-members');
Route::get('/group/{id}/history', 'GroupController@historyList')->name('group-history');
Route::post('/save-settings', 'GroupController@postSaveSettings')->name('save-settings');
Route::get('/restaurants', 'RestaurantController@getList')->name('restaurants');
Route::get('/restaurants/remove/{restaurantId}', 'RestaurantController@remove')->name('remove');
Route::post('/restaurants/saveBudget', 'RestaurantController@saveBudget')->name('saveBudget');
Route::get('/restaurants/add/{groupId}', 'RestaurantController@addRestaurant')->name('addRestaurant');
Route::post('/restaurants/save', 'RestaurantController@saveRestaurant')->name('saveRestaurant');
Route::post('/new-member', 'GroupController@postNewMember')->name('new-member');
Route::get('/group/delete/{groupId}', 'GroupController@getDeleteGroup')->name('group-delete');
Route::get('/group/member/delete/{groupId}/{userId}', 'GroupController@getGroupMemberDelete')->name('group-member-delete');
Route::get('/generate/{groupId}', 'GroupController@getGenerate')->name('generate');
Route::get('/regenerate/{groupId}', 'GroupController@getGenerate')->name('regenerate');
