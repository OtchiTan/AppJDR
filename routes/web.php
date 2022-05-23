<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Personnage;
use App\Http\Controllers\Room;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [Dashboard::class, 'Index'])->name('dashboard');
    Route::get('/createRoom', [Room::class, 'CreateRoom'])->name('createRoom');
    Route::get('/room/{id}', [Room::class, 'RoomPage'])->name('joinRoom');
    Route::get('/personnages', [Personnage::class, 'Liste'])->name('personnages');
});
