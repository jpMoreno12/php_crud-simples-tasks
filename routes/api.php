<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Laravel\Passport\Client;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/clients', function () {
    return Client::all();
});

Route::middleware('auth:api')->group(function () {
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index');
        Route::post('/tasks', 'store');
        Route::put('/tasks/{id}', 'update');
        Route::delete('tasks/{id}', 'destroy');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::post('/users', [UserController::class, 'updateUser']);
    Route::put('/users/{id}', [UserController::class, 'deleteUser']);
});

Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
Route::get('/getUser{id}', [UserController::class, 'getUser']);
Route::post('/createUser', [UserController::class, 'createUser']);     

// Route::put('/updateUser', [UserController::class, 'updateUser']);  
// Route::delete('/deleteUser', [UserController::class, 'deleteUser']); 
// Route::get('/getAllTasks', [TaskController::class, 'index']);        
// Route::post('/createTask', [TaskController::class, 'store']);       
// Route::put('/updateTask{id}', [TaskController::class, 'update']);  
// Route::delete('/deleteTask{id}', [TaskController::class, 'destroy']); 
