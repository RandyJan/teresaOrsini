<?php

use App\Http\Controllers\sensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Models\sensorData;
use App\Models\User;

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
Route::post('/sendDataToServer',[sensorController::class,'update']);
Route::get('/getData',[sensorController::class,'show']);
Route::post('/register',[authController::class,'signin']);
Route::post('/login',[authController::class,'login']);
Route::get('/getLogs',[sensorController::class,'getLogs']);
Route::post('/changepw',[authController::class,'changepw']);
Route::post('/saveLogs',[sensorController::class,'saveLogs']);
Route::get('/getRecords',[sensorController::class,'getAllRecords']);
Route::post('/accessWeb',[authController::class,'accessWeb']);
Route::post('/accessRegis',[authController::class,'accessRegis']);
Route::post('/clearLogs',[sensorController::class,'clearLogs']);
