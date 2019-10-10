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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users', 'UsersController@index');
Route::get('/users/edit/{id}', 'UsersController@edit');
Route::patch('/users/edit/{id}', 'UsersController@update');
Route::delete('/users/{id}', 'UsersController@destroy');


Route::get('/items', 'ItemsController@index');
Route::get('/items/edit/{id}', 'ItemsController@edit');
Route::patch('/items/edit/{id}', 'ItemsController@update');
Route::delete('/items/{id}', 'ItemsController@destroy');
Route::get('/items/create', 'ItemsController@create');
Route::post('/items/create', 'ItemsController@store');



Route::get('/stockmovements', 'StockMovementsController@index');
Route::get('/stockmovements/edit/{id}', 'StockMovementsController@edit');
Route::patch('/stockmovements/edit/{id}', 'StockMovementsController@update');
Route::delete('/stockmovements/{id}', 'StockMovementsController@destroy');
Route::get('/stockmovements/create', 'StockMovementsController@create');
Route::post('/stockmovements/create', 'StockMovementsController@store');



Route::get('/orders', 'OrdersController@index');
Route::get('/orders/edit/{id}', 'OrdersController@edit');
Route::patch('/orders/edit/{id}', 'OrdersController@update');
Route::delete('/orders/{id}', 'OrdersController@destroy');
Route::get('/orders/create', 'OrdersController@create');
Route::post('/orders/create', 'OrdersController@store');

Route::get('/orders/stockmovementsorder/{id}', 'StockMovementOrdersController@index');

Route::get('/stockoverview', 'HomeController@stockoverview');