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
Route::group(['namespace' => 'Admin'],function(){
    Route::get('/','LoginController@showLoginForm')->name('admin.login');    
    Route::post('login', 'LoginController@adminLogin');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');
        Route::get('/change/password/form', 'LoginController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'LoginController@changePassword')->name('admin.change_password');

        Route::get('/sticker/add/form', 'StickerController@addStickerForm')->name('admin.add_sticker_form');
        Route::get('/sticker/list', 'StickerController@stickerList')->name('admin.sticker_list');
        Route::get('/sticker/delete/{id}', 'StickerController@deleteSticker')->name('admin.delete_sticker');
        Route::post('/sticker/add', 'StickerController@addSticker')->name('admin.add_sticker');

        Route::get('/template/add/form', 'TemplateController@addTemplateForm')->name('admin.add_template_form');
        Route::get('/template/list', 'TemplateController@templateList')->name('admin.template_list');
        Route::get('/template/delete/{id}', 'TemplateController@deleteTemplate')->name('admin.delete_template');
        Route::post('/template/add', 'TemplateController@addTemplate')->name('admin.add_template');

    });

});

// Route::get('/', function () {
//     return view('admin.index');
// });
