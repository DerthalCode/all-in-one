<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\UserController;
use App\Models\Category;

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
Route::get('/', [CompanyController::class, 'index']);
Route::get('/add-company', [CompanyController::class, 'addCompany']);
Route::post('/store', [CompanyController::class, 'storeCompany']);
Route::get('/company/{company}', [CompanyController::class, 'showCompany']);
Route::get('/delete/company/{company}', [CompanyController::class, 'deleteCompany']);
Route::get('/update/company/{company}', [CompanyController::class, 'updateCompany']);
Route::post('/update/{company}', [CompanyController::class, 'storeUpdate']);
Route::get('/import-companies', [CompanyController::class, 'importCompanies']);
Route::post('/parse-companies', [CompanyController::class, 'parseCompaniesImport']);
Route::post('/store-companies-import', [CompanyController::class, 'storeCompaniesImport'])->name("store-companies-import");
Route::get('/company-catalogs', [CompanyController::class, 'showCatalogs']);
Route::post('/update-category/{company}', [CompanyController::class, 'updateCategory']);

Route::post('/company/{company}/comment', [CommentController::class, 'create']);

Route::get('/add-category', [CategoryController::class, 'showAddCategory']);
Route::post('/create-category', [CategoryController::class, 'create']);
Route::get('/company-categories', [CategoryController::class, 'showCompanies']);

Route::get('/catalog/{company}', [GoodsController::class, 'showCatalog']);

Route::get('/dashboard', [UserController::class, 'showDashboard']);
Route::get('order/{goods}', [UserController::class, 'takeOrder']);

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
