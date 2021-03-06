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

Route::get('/', 'FbInsightsController@index');

Route::post('/keyword_stats', 'FbInsightsController@keywordStats');
Route::get('/fb_insight', 'FbInsightsController@index')->name('home');
Route::get('/fb_redirect', 'SocialAuthController@fbRedirect');
Route::get('/fb_callback', 'SocialAuthController@fbCallback');

Route::get('/privacy', 'HomeController@privacy');
Route::get('/terms', 'HomeController@terms');


Auth::routes();
