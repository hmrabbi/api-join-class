<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;


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

Route::post('register',[RegisterController::class,'register']);

Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {

    Route::post('dcreate', [DoctorController::class,'createDoctor']);
    Route::post('pcreate', [PatientController::class,'patientInerJoin']);
    Route::get('docwisept', [PatientController::class,'inerJoin']);
    Route::get('docwiseptleftjoin', [PatientController::class,'leftJoin']);
    Route::get('docwiseptrightjoin', [PatientController::class,'rightJoin']);

});

