<?php

use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ViewsController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('estates', [EstateController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('estates/{estate}', [EstateController::class, 'show']);
Route::post('leads', [LeadController::class, 'store']);
Route::post('views', [ViewsController::class, 'store']);

