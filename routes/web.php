<?php

use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth');
// });

Route::get('/', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/dashboard', function () {
    return view('welcome');
})->name('welcome');
