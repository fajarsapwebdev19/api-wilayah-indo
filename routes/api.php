<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route API Wilayah Indonesia
// get all data
Route::get('/provinces', [ApiController::class, 'get_provices']);
Route::get('/data_regencies', [ApiController::class, 'data_regency']);
Route::get('/data_districts', [ApiController::class, 'data_districts']);
Route::get('/data_villages', [ApiController::class, 'data_villages']);

// get data use dependency
Route::get('/regencies/{id}', [ApiController::class, 'get_regency']);
Route::get('/districts/{id}', [ApiController::class, 'get_districts']);
Route::get('/villages/{id}', [ApiController::class, 'get_villages']);

// select 2

// data kabupaten / kota
Route::get('/select2/data_regencies', [ApiController::class, 'select2_get_regencies']);

// data kecamatan
Route::get('/select2/data_districts', [ApiController::class, 'select2_get_districts']);

//data kelurahan / desa
Route::get('/select2/data_villages', [ApiController::class, 'select2_get_villages']);

