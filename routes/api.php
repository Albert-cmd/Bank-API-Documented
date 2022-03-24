<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

//Comptes
Route::get('/comptes', [ApiController::class, 'getComptes']);
Route::get('/compteById/{id}',[ApiController::class,'compteById']);
Route::put('/compte/{id}', [ApiController::class, 'updateCompte']);
Route::post('/addCompte',[ApiController::class,'postCompte']);
Route::delete('/compte/delete/{id}',[ApiController::class,'deleteCompte']);

//Clients
Route::get('/clients', [ApiController::class, 'getClients']);
Route::get('/clientById/{id}',[ApiController::class,'clientByid']);
Route::put('/client/{id}', [ApiController::class, 'updateClient']);
Route::post('/addClient',[ApiController::class,'postClient']);
Route::delete('/client/delete/{id}',[ApiController::class,'deleteClient']);

