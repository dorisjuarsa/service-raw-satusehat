<?php

use App\Http\Controllers\Api\SsTahapanFasyankesController;
use App\Http\Controllers\Api\SsRinciResourceFasyankesController;
use App\Http\Controllers\Api\SsMonitoringIntegrasiSatusehatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ss-tahapan-fasyankes', [SsTahapanFasyankesController::class, 'index']);
Route::post('/ss-tahapan-fasyankes', [SsTahapanFasyankesController::class, 'store']);
Route::post('/ss-tahapan-fasyankes/import', [SsTahapanFasyankesController::class, 'import']);
Route::get('/ss-tahapan-fasyankes/{kode_sarana}', [SsTahapanFasyankesController::class, 'show']);
Route::put('/ss-tahapan-fasyankes/{kode_sarana}', [SsTahapanFasyankesController::class, 'update']);
Route::delete('/ss-tahapan-fasyankes/{kode_sarana}', [SsTahapanFasyankesController::class, 'destroy']);

Route::get('/ss-rinci-resource-fasyankes', [SsRinciResourceFasyankesController::class, 'index']);
Route::post('/ss-rinci-resource-fasyankes', [SsRinciResourceFasyankesController::class, 'store']);
Route::post('/ss-rinci-resource-fasyankes/import', [SsRinciResourceFasyankesController::class, 'import']);
Route::get('/ss-rinci-resource-fasyankes/{kode_sarana}', [SsRinciResourceFasyankesController::class, 'show']);
Route::put('/ss-rinci-resource-fasyankes/{kode_sarana}', [SsRinciResourceFasyankesController::class, 'update']);
Route::delete('/ss-rinci-resource-fasyankes/{kode_sarana}', [SsRinciResourceFasyankesController::class, 'destroy']);

Route::get('/ss-monitoring-integrasi-satusehat', [SsMonitoringIntegrasiSatusehatController::class, 'index']);
Route::post('/ss-monitoring-integrasi-satusehat', [SsMonitoringIntegrasiSatusehatController::class, 'store']);
Route::post('/ss-monitoring-integrasi-satusehat/import', [SsMonitoringIntegrasiSatusehatController::class, 'import']);
Route::get('/ss-monitoring-integrasi-satusehat/{kode_sarana}', [SsMonitoringIntegrasiSatusehatController::class, 'show']);
Route::put('/ss-monitoring-integrasi-satusehat/{kode_sarana}', [SsMonitoringIntegrasiSatusehatController::class, 'update']);
Route::delete('/ss-monitoring-integrasi-satusehat/{kode_sarana}', [SsMonitoringIntegrasiSatusehatController::class, 'destroy']);
