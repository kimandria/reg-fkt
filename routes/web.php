<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PrefetController;
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

//Prefecture
Route::get('/show/{id}', [NavController::class, 'show']);
Route::post('/prefecture_save', [NavController::class, 'savepref']);
Route::get('/edit/{id}', [NavController::class, 'edit']);
Route::post('/prefecture', [NavController::class, 'update']);
Route::get('/delete/{id}', [NavController::class, 'delete_pref']);

//Prefecture API
// Route::get('/api/prefectures', [NavController::class, 'prefecturelist']);
// Route::get('/api/prefectures/{id}', [NavController::class, 'prefecturedetail']);
// Route::post('/api/prefectures/', [NavController::class, 'addprefecture']);
// Route::post('/api/prefecture/{id}', [NavController::class, 'updateprefecture']);
// Route::get('/api/delete/{id}', [NavController::class, 'deleteprefecture']);

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
