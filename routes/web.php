<?php

use App\Livewire\AkunManager;
use App\Livewire\Login;
use App\Livewire\MenuManager;
use App\Livewire\PengelolaDashboard;
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
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/access-denied', function () {
    return view('components.layouts.403');
})->name('access-denied');

Route::group(['middleware' => ['auth', 'role:1'], 'prefix' => 'pengelola'], function () {
    Route::get('/dashboard', PengelolaDashboard::class)->name('pengelola-dashboard');
    Route::get('/manajemen-akun', AkunManager::class)->name('manajemen-akun');
    Route::get('/manajemen-menu', MenuManager::class)->name('manajemen-menu');
});
