<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\LoginController;

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
Route::get('/', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

Route::get('/register', [LoginController::class, 'register'])->name('register');

Route::post('/auth-register', [LoginController::class, 'authRegister'])->name('auth.register');

Route::get('/principal/{success?}', [CalendarController::class, 'index'])->name('index')->middleware('auth');

Route::get('/create-event/{data}', [CalendarController::class, 'createEvent'])->middleware('auth')->name('create.event');

Route::get('/alter-event/{id}',[CalendarController::class, 'alterEvent'])->middleware('auth');

Route::get('/drop-event/{id}', [CalendarController::class, 'dropEvent'])->middleware('auth')->name('drop.event');

Route::post('/edit-event', [CalendarController::class, 'editEvent'])->middleware('auth')->name('edit.event');

Route::get('/addevent', [CalendarController::class, 'addEvento'])->middleware('auth')->name('agendar.evento');

Route::post('/confirm-agenda', [ConfirmationController::class, 'confirm'])->middleware('auth')->name('confirm.agenda');