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
// Route::get('/',function(){
// 	return view('welcome');
// });

Route::get('/','InvoicingController@index');
Route::post('CreateInvoice','InvoicingController@create');
Route::get('ShowInvoice','InvoicingController@show');
Route::get('SearchInvoice/{SearchInvoice}','InvoicingController@Search');
Route::get('ShowInvoice/Delete/{id}','InvoicingController@InvoiceDelete');
Route::get('ShowInvoice/Edit/{id}','InvoicingController@InvoiceEdit');
Route::post('ShowInvoice/Edit/{id}','InvoicingController@InvoiceUpdate');
Route::get('ShowInvoice/PDF/{id}','InvoicingController@ShowPDF');



