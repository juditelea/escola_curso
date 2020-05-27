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
Route::resource('alunos', 'AlunosController');    //->middleware('auth');
Route::resource('cursos', 'CursosController');   //->middleware('auth'); //->middleware('auth');
Route::get('outros', 'AlunosController@mostra');

Route::get('/login', function () {
    return "Login";
})->name('login');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/alunos', function () {
//     return view('alunos.teste');
// });

