<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApotekController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\NotaController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::middleware('auth:sanctum')->group(function () {

   
    Route::post('/logout', [AuthController::class, 'logout']);

   
    Route::apiResource('apotek', ApotekController::class);

    
    Route::apiResource('barang', BarangController::class);

    
    Route::apiResource('nota', NotaController::class);

});
