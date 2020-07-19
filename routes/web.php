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
});

###############End Ajax routes##############
