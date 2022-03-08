<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\AuthController;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/companies', [ApiController::class, 'companies']);
Route::get('/company/{company}', [ApiController::class, 'company']);

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//auth group
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('/add-company', [ApiController::class, 'addCompany']);
    Route::get('/my-companies', [ApiController::class, 'myCompanies']);
    Route::post('/delete-company/{company}', [ApiController::class, 'deleteMyCompany'])->can('delete', 'company');
    Route::post('/update-company/{company}', [ApiController::class, 'updateMyCompany'])->can('update', 'company');
});