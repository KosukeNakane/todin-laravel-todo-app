<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//ログイン時はTODO一覧画面へ、未ログイン時はトップ画面へリダイレクト
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('todos.index');
    }

    return view('pages.top.index');
})->name('top');

//ログイン時にアクセス可能なルート
Route::middleware('auth')->group(function () {
    Route::get('/index', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/{task}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{task}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::patch('/todos/{task}/complete', [TodoController::class, 'complete'])->name('todos.complete');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');

});

require __DIR__.'/auth.php';
