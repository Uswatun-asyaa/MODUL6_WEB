<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource("anggota", AnggotaController::class);
// Route::middleware(['auth:api'])->group(function () {
// Route::prefix("v1")->group(function () {


// });