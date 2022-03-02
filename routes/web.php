<?php

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
//Essa linha importa o arquivo EventController
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

//Essa linha importa o método index do arquivo EventController
Route::get('/', [EventController::class, 'index']); //Essa barra representa o arq. home

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);

Route::delete('/events/{id}', [EventController::class, 'destroy']);
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
//Route::get('/contact', [ContactController::class, 'index']);
//Route::get('/products', [ProductController::class, 'index']);

Route::post('events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');



/*Route::get('/contact', function () {
    return view('contact');
});*/

/*Route::get('/produtos', function () {
    $busca = request('search');

    return view('products', ['busca' => $busca]);
});*/

//Passar parâmetros pela URL
//Rota passando id como parâmetro
/*Route::get('/produtos/{id}', function ($id) {
    return view('product', ['id' => $id]);
});*/


//O sinal de '?' é pra... 
/*Route::get('/produtos_teste/{id?}', function ($id=null) {
    return view('product', ['id' => $id]);
});*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/
