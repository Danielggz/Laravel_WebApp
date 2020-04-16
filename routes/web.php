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
Route::get('login', function () {
    return view('login');
});

//get link to prices/index
Route::get('prices.index', 'PriceController@index');
//Route to reset prices datatable
Route::get('destroyPrices', function () {
    $prices = Price::all();
    Price::truncate();
    return redirect('/prices.index')->with('table_destroyed', 'Table values deleted');
});
//prices controller resource
Route::resource('prices','PriceController');

//Default routes added by laravel auth system
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
