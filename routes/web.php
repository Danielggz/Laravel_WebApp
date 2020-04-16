<?php
use App\Price;
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
    return view('home');
});

// Route::get('login', function () {
//     return view('login');
// });

// Route::get('users', function()
// {
//     return View::make('users');
// });

// Route::get('pricesview', function()
// {
//     return view('prices');
// });

// Route::post('prices.store', 'PricesController@store');

Route::get('login', function () {
    return view('login');
});

Route::get('prices.index', 'PriceController@index');
Route::get('destroyPrices', function () {
    $prices = Price::all();
    Price::truncate();
    return redirect('/prices.index')->with('table_destroyed', 'Table values deleted');
});
Route::resource('prices','PriceController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
