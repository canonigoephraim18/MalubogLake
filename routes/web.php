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

Route::get('/', function () {
    return view('index');
});

Route::get('/reserves', 'App\Http\Controllers\ItemsController@show')->name('reserves');
Route::get('/reviewshiking', 'App\Http\Controllers\ReviewsController@viewHiking');
Route::get('/reviewsfishing', 'App\Http\Controllers\ReviewsController@viewFishing');
Route::get('/reviewsovernightstay', 'App\Http\Controllers\ReviewsController@viewOvernightstay');



Route::middleware('auth:')->group(function (){

Route::view('home', 'index');
Route::get('/reservelist', 'App\Http\Controllers\ReservesController@reserveList');
Route::post('/addtocart/{items}', 'App\Http\Controllers\ItemsController@addToCart');
Route::get('/removecart/{reserves}', 'App\Http\Controllers\ReservesController@removeToCart');
Route::patch('/editcart/{reserves}', 'App\Http\Controllers\ReservesController@editCart');


Route::view('/items', 'add_item')->name('items');
Route::post('/items', 'App\Http\Controllers\ItemsController@store');
Route::get('/editItem/{items}', 'App\Http\Controllers\ItemsController@editItem');
Route::get('/removeItem/{items}', 'App\Http\Controllers\ItemsController@removeItem');
Route::patch('/updateItem/{items}', 'App\Http\Controllers\ItemsController@updateItem');
Route::get('/outofstockItem/{items}', 'App\Http\Controllers\ItemsController@setoutItem');

Route::post('/reviewsadd', 'App\Http\Controllers\ReviewsController@addcomment');
Route::get('/deletesreview/{comments}', 'App\Http\Controllers\ReviewsController@deleteComment');

Route::get('/checkout', 'App\Http\Controllers\CheckoutsController@store');
Route::get('/checkoutlist', 'App\Http\Controllers\CheckoutsController@index');
Route::get('/checkoutdetail/{checkouts}', 'App\Http\Controllers\CheckoutsController@show');
Route::get('/removedetail/{checkouts}', 'App\Http\Controllers\CheckoutsController@removeCheckout');
Route::get('/checkoutcancel/{checkouts}', 'App\Http\Controllers\CheckoutsController@cancelCheckout');
Route::get('/allcheckout', 'App\Http\Controllers\CheckoutsController@allCheckouts');

Route::post('/comments/{comment}/like', 'App\Http\Controllers\CommentLikesController@store');

});






