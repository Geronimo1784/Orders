<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Init\InitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Init();
Route::get('/', [InitController::class, 'Index']);  
Route::get('Detail-item/{code}', [InitController::class, 'Details']);
    
#Guardar Pedidos 
Route::get('Save-Pedido', [InitController::class, 'SavePedido']); 
Route::post('Save-Pedido', [InitController::class, 'SavePedido']); 

/* Route::get('/', function () {
    return view('welcome');
}); */
