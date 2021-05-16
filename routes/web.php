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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->where('any', '.*');
Route::get('/home', 'HomeController@index')->name('home')->where('any', '.*');

$router->get('/news-list', ['uses' => 'ScraperController@getNewsList']);
$router->get('/article/{url}', ['uses' => 'ScraperController@getArticle'])->where('url', '.*');
