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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/redirect/{service}','SocialController@edirect');

Route::get('/callback/{service}','SocialController@callback');



Route::get('/fillable','CrudController@getoffers');


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::group(['prefix'=>'offers'],function(){

        Route::get('all','CrudController@getAllOffers')->name('offer_all');

        Route::get('form','CrudController@show_form');
        Route::post('store','CrudController@store')->name('offers_store');

        Route::get ('edit/{offer_id}','CrudController@editoffer');
        Route::post('update/{offer_id}','CrudController@updateoffer')->name('offers_update');

        Route::get ('delte/{offer_id}','CrudController@deleteoffer')->name('offers_delete');

        Route::get('youtube','CrudController@getvideo');

    });
});

###############start Ajax routes##############
Route::group(['prefix' => 'ajaxoffers'], function () {

    Route::get('create','OfferController@create');
    Route::post('store','OfferController@store')->name('store_ajax');

    Route::get('all','OfferController@getall')->name('ajaxoffer_all');
    Route::post('delete','OfferController@delete')->name('delete_ajax');

    Route::get ('edit/{offer_id}','OfferController@edit')->name('edit_ajax');
    Route::post('update','OfferController@update')->name('update_ajax');

});

###############End Ajax routes##############


###############Start authentication && Guards ##############
Route::group(['middleware' => 'CheckAge','namespace'=>'Auth'], function () {

Route::get('adults','CustomAuthController@Adult')->name('adult');



});

Route::group(['namespace'=>'Auth'], function () {

Route::get('site','CustomAuthController@site')->middleware('auth:web')->name('user');
Route::get('admin','CustomAuthController@admin')->middleware('auth:admin')->name('admin');


});


Route::get('admin/login','Auth\CustomAuthController@admin_login')->name('admin_login');

Route::post('admin/login','Auth\CustomAuthController@checkadminlogin')->middleware('auth:doctor_admin')->name('save_admin_login');




###############End authentication && Guards ##############
Route::get('/show',function(){
return 'not adult';
})->name('not_adult');




