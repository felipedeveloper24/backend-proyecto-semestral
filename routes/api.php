<?php

use App\Http\Controllers\CentroDistribucionController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\medicamentoController;
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

Route::prefix("farmacia")->controller(FarmaciaController::class)->group(function(){
    Route::get("/all","listar_farmacias");
    Route::post("/create","crear_farmacia");
    Route::put("/update","actualizar_farmacia");
    Route::delete("/delete","eliminar_farmacia");
});

Route::prefix("centro")->controller(CentroDistribucionController::class)->group(function(){
    Route::get("/all","listar_centros");
    Route::post("/create","crear_centro");
    Route::put("/update","actualizar_centro");
    Route::delete("/delete","eliminar_centro");
});
Route::prefix("medicamento")->controller(medicamentoController::class)->group(function(){
    Route::get("/all","listar_medicamentos");
    Route::post("/create","crear_medicamento");
    Route::put("/update","actualizar_medicamento");
    Route::delete("/delete","eliminar_medicamento");
});
