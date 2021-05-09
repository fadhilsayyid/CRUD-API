<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import-form',[LoginController::class,'importForm']);

Route::post('/import',[LoginController::class,'import'])->name('user.import'); 

Route::post('/export',[LoginController::class,'export'])->name('user.export'); 

Route::get('/userList',[LoginController::class,'userList']);
