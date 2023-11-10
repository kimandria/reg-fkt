<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Navigation
Route::get('/', [NavController::class, 'index']);
Route::get('/prefecture', [NavController::class, 'prefecture']);
Route::get('/district', [NavController::class, 'district']);
Route::get('/borough', [NavController::class, 'borough']);
Route::get('/fonkotany', [NavController::class, 'fonkotany']);
Route::get('/citizens', [NavController::class, 'citizens']);
Route::get('/book', [NavController::class, 'book']);

//Prefecture
Route::get('/show/{id}', [NavController::class, 'show']);
Route::post('/prefecture_save', [NavController::class, 'savepref']);
Route::get('/edit/{id}', [NavController::class, 'edit']);
Route::post('/prefecture', [NavController::class, 'update']);
Route::get('/delete/{id}', [NavController::class, 'delete_pref']);

//District
Route::post('/district', [NavController::class, 'saveDistrict']);
Route::get('/showdist/{id}', [NavController::class, 'showdist']);
Route::get('/editdist/{id}', [NavController::class, 'editdist']);
Route::post('/district_update', [NavController::class, 'updatedist']);
Route::get('/deleteDist/{id}', [NavController::class, 'delete_dist']);

//Borough
Route::post('/borough_save', [NavController::class, 'saveBorough']);
Route::get('/showborough/{id}', [NavController::class, 'showBorough']);
Route::get('/editborough/{id}', [NavController::class, 'editborough']);
Route::post('/borough_update', [NavController::class, 'updateBorough']);
Route::get('/deleteborough/{id}', [NavController::class, 'delete_borough']);

//Fokontany
Route::get('/showfkt/{id}', [NavController::class, 'showfkt']);
Route::post('/fkt_save', [NavController::class, 'savefkt']);
Route::get('/editfkt/{id}', [NavController::class, 'editfkt']);
Route::post('/fkt_update', [NavController::class, 'updateFkt']);
Route::get('/deletefkt/{id}', [NavController::class, 'delete_fkt']);

//Citizens
Route::post('/citizens_save', [NavController::class, 'addCitizen']);
Route::get('/citizenslist', [NavController::class, 'citizenslist']);
Route::get('/editcitizens/{id}', [NavController::class, 'editCitizens']);
Route::post('/citizens_update', [NavController::class, 'updateCitizens']);
Route::get('/deleteCitizens/{id}', [NavController::class, 'deleteCitizens']);

//Book
Route::post('/book_save', [NavController::class, 'addBook']);
Route::get('/editbook/{id}', [NavController::class, 'editBook']);
Route::post('/book_update', [NavController::class, 'updateBook']);
