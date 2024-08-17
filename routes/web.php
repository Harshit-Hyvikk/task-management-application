<?php

use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    $categories = Category::all();
    $tasks = Task::all();
    return view('welcome', compact('categories', 'tasks'));
});


Route::get('/alltrashdelete', [TaskController::class, 'alltrashDelete'])->name('alltrash.delete');
Route::get('/soft-delete-retrive/{id}', [TaskController::class, 'softdeleteRetrive'])->name('tasks.softdelete.retrive');




Route::view('register', '/register')->name('register');
Route::post('/registersave', [UserController::class, 'register'])->name('register.save');

Route::view('login', '/login')->name('login');
Route::post('/userlogin', [UserController::class, 'login'])->name('login.save');


Route::middleware(['auth'])->group(function () {
    Route::resource('/alltasks', TaskController::class);
    Route::resource('/allcategories', CategoryController::class);

    Route::get('/trashtasksshow/{id}', [TaskController::class, 'softdeleteShow'])->name('tasks.softdelete.show');
    Route::get('/trashtasksrollback/{id}', [TaskController::class, 'softdeleteRollback'])->name('tasks.softdelete.rollback');
    Route::delete('/softdelete/{id}', [TaskController::class, 'softdelete'])->name('tasks.softdelete');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});



