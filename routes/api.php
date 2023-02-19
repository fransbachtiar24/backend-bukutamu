<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatTamuController;
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
// ================================handle sistem login============================
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
// ===============================================================================

// =============================handle pegawai=====================================
Route::get("/pegawai/all", [PegawaiController::class, 'index']);
Route::get("/pegawai/{id}", [PegawaiController::class, 'byId']);
Route::post("/pegawai/add", [PegawaiController::class, "create"]);
Route::put("/pegawai/{id}", [PegawaiController::class, "edit"]);
Route::delete("/pegawai/{id}", [PegawaiController::class, "destroy"]);
// ================================================================================


// ============================handle riyawat tamu=================================
Route::get("/riwayat-tamu/all", [RiwayatTamuController::class, "index"]);
Route::get("/riwayat-tamu/{id}", [RiwayatTamuController::class, "byId"]);
Route::post("/riwayat-tamu/add", [RiwayatTamuController::class, "create"]);
Route::put("/riwayat-tamu/{id}", [RiwayatTamuController::class, "edit"]);
Route::delete("/riwayat-tamu/{id}", [RiwayatTamuController::class, "destroy"]);
// ================================================================================

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});