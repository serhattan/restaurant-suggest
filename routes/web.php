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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => '/settings'], function () {
        Route::get('/', 'HomeController@settings')->name('settings');
        Route::post('/', 'HomeController@update')->name('saveSettings');
        Route::post('/save', 'GroupController@postSaveSettings')->name('save-settings');
    });
    Route::get('/history', 'HomeController@historyList')->name('history');
    Route::get('/groups', 'GroupController@getList')->name('groups');
    Route::get('/new-group', 'GroupController@getNew')->name('new-group');
    Route::post('/new-group', 'GroupController@postNew')->name('new-group');

    Route::group(['prefix' => '/group/{id}'], function () {
        Route::get('/details', 'GroupController@getDetails')->name('group-details');
        Route::get('/restaurants', 'GroupController@getRestaurants')->name('group-restaurants');
        Route::get('/settings', 'GroupController@getSettings')->name('group-settings');
        Route::get('/members', 'GroupController@getMembers')->name('group-members');
        Route::get('/history', 'GroupController@historyList')->name('group-history');
        Route::group(['middleware' => ['isAdmin']], function () {
            Route::get('/delete/{groupId}', 'GroupController@getDeleteGroup')->name('group-delete');
            Route::get('/member/delete/{groupId}/{userId}', 'GroupController@getGroupMemberDelete')->name('group-member-delete');
        });
    });

    Route::group(['prefix' => '/restaurants'], function () {
        Route::get('', 'RestaurantController@getList')->name('restaurants');
        Route::get('/remove/{restaurantId}', 'RestaurantController@remove')->name('remove');
        Route::post('/saveBudget', 'RestaurantController@saveBudget')->name('saveBudget');
        Route::get('/add/{groupId}', 'RestaurantController@addRestaurant')->name('addRestaurant');
        Route::post('/save', 'RestaurantController@saveRestaurant')->name('saveRestaurant');
    });

    Route::post('/new-member', 'GroupController@postNewMember')->name('new-member');
    Route::get('/generate/{groupId}', 'GroupController@getGenerate')->name('generate');
    Route::get('/regenerate/{groupId}', 'GroupController@getRegenerate')->name('regenerate');
    Route::get('/generate', 'GenerateController@generateList')->name('restaurantGenerate');
});