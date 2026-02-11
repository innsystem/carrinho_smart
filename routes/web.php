<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\DespesaItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página inicial - redireciona para login ou dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rotas protegidas (requer autenticação)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Despesas
    Route::get('/despesas', [DespesaController::class, 'index'])->name('despesas.index');
    Route::get('/despesas/create', [DespesaController::class, 'create'])->name('despesas.create');
    Route::get('/despesas/{despesa}', [DespesaController::class, 'show'])->name('despesas.show');
    Route::put('/despesas/{despesa}', [DespesaController::class, 'update'])->name('despesas.update');
    Route::delete('/despesas/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy');
    
    // Itens da despesa
    Route::post('/despesas/{despesa}/itens', [DespesaItemController::class, 'store'])->name('despesa-itens.store');
    Route::put('/despesas/{despesa}/itens/{item}', [DespesaItemController::class, 'update'])->name('despesa-itens.update');
    Route::delete('/despesas/{despesa}/itens/{item}', [DespesaItemController::class, 'destroy'])->name('despesa-itens.destroy');
});
