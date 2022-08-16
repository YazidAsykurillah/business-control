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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Role
Route::get('role/datatables', 'Datatables\RoleDatatablesController@index');
Route::resource('role','RoleController');

//Permission
Route::resource('permission','PermissionController');

//User
Route::get('user/select2', 'Select2\UserSelect2Controller@index');
Route::get('user/datatables','Datatables\UserDatatablesController@index');
Route::resource('user','UserController');

//Customer
Route::get('customer/select2', 'Select2\CustomerSelect2Controller@index');
Route::get('customer/{id}/contact-datatables','Datatables\CustomerDatatablesController@getContacts');
Route::get('customer/datatables','Datatables\CustomerDatatablesController@index');
Route::resource('customer','CustomerController');

//Customer Contact
Route::resource('customer-contact','CustomerContactController');

//Quotation Customer
Route::get('quotation-customer/datatables','Datatables\QuotationCustomerDatatablesController@index');
Route::resource('quotation-customer','QuotationCustomerController');