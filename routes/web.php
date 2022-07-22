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
    return view('pages.firstpage');
});

Route::get('/home', function () {
    return view('pages.firstpage');
});

Route::get('/admin', function () {
    return view('pages.admin');
});

Route::get('/firstpage', function () {
    return view('pages.firstpage');
});
Route::get('/firstpage/add/{id}',[\App\Http\Controllers\productController::class,'storeBadge']);



Route::get('/bread',[\App\Http\Controllers\productController::class,'indexBread']);

Route::get('/cake',[\App\Http\Controllers\productController::class,'indexCake']);

Route::get('/food',[\App\Http\Controllers\productController::class,'indexFood']);


Route::get('/gallery', function () {
    return view('pages.gallery');
});

Route::get('/product/list',[\App\Http\Controllers\productController::class,'index']);
Route::get('/product/add',[\App\Http\Controllers\productController::class,'create']);
Route::post('/product/add',[\App\Http\Controllers\productController::class,'store']);
Route::delete('/product/list',[\App\Http\Controllers\productController::class,'destroy']);
Route::get('/product/edit/{id}',[\App\Http\Controllers\productController::class,'edit']);
Route::put('/product/edit/{id}',[\App\Http\Controllers\productController::class,'update']);

Route::get('/product/property/{id}',[\App\Http\Controllers\productController::class,'indexProperty']);
Route::get('/product/property/{id}/create',[\App\Http\Controllers\productController::class,'createProperty']);
Route::post('/product/property/{id}/create',[\App\Http\Controllers\productController::class,'storeProperty']);
Route::delete('/product/property/{id}',[\App\Http\Controllers\productController::class,'destroyProperty']);
Route::get('/product/property/{id}/{idPivot}/edit',[\App\Http\Controllers\productController::class,'editProperty']);
Route::put('/product/property/{id}/{idPivot}/edit',[\App\Http\Controllers\productController::class,'updateProperty']);

Route::middleware(['auth'])->group(function (){
    Route::get('/special',[\App\Http\Controllers\specialController::class,'create']);

});

Route::get('/special/list',[\App\Http\Controllers\specialController::class,'index']);
Route::post('{id}/special/add',[\App\Http\Controllers\specialController::class,'store']);

Route::resource('categories',\App\Http\Controllers\categoryController::class);

Route::resource('properties',\App\Http\Controllers\propertyController::class);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('product/search',[\App\Http\Controllers\userController\ajaxController::class,'search']);

Route::post('badge/index',[\App\Http\Controllers\userController\ajaxController::class,'index']);
Route::middleware(['auth'])->post('badge/add',[\App\Http\Controllers\userController\ajaxController::class,'store']);
Route::middleware(['auth'])->post('badge/create',[\App\Http\Controllers\userController\ajaxController::class,'create']);
Route::patch('badge/update',[\App\Http\Controllers\userController\ajaxController::class,'update']);
Route::delete('badge/index',[\App\Http\Controllers\userController\ajaxController::class,'destroy']);

Route::get('/orders/list',[\App\Http\Controllers\orderController::class,'index']);
Route::get('/order/edit/{id}',[\App\Http\Controllers\orderController::class,'edit']);
Route::delete('/orders/list',[\App\Http\Controllers\orderController::class,'destroy']);

Route::get('user/list',[\App\Http\Controllers\userController::class,'index']);
Route::get('user/create',[\App\Http\Controllers\userController::class,'create']);
Route::post('user/create',[\App\Http\Controllers\userController::class,'store']);
Route::delete('user/list',[\App\Http\Controllers\userController::class,'destroy']);
