<?php

use App\Http\Controllers\FarmaciaController;
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

