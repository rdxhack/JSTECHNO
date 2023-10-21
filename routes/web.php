<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\products;

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
Route::get('/category', function () {
    return view('catadd');
});

Route::post('/catadd', [products::class, 'catadd']);

Route::post('add/product', [products::class, 'insert_product']);
Route::get('/categorylist', [products::class, 'catlist']);
Route::get('/product_list', [products::class, 'product_list']);
Route::post('/product/delete/{id}', [products::class, 'product_del']);
Route::match(['get', 'post'], '/product/view/{id}', [products::class, 'product_view']);
Route::post('/update/product', [products::class, 'product_update']);