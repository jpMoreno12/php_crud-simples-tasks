<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);      
Route::get('/getUser{id}', [UserController::class, 'getUser']);     
Route::post('/createUser', [UserController::class, 'createUser']);     
Route::put('/updateUser', [UserController::class, 'updateUser']);  
Route::delete('/deleteUser', [UserController::class, 'deleteUser']); 

Route::get('/getAllTasks{id}', [TaskController::class, 'index']);        
Route::post('/createTask', [TaskController::class, 'store']);       
Route::put('/updateTask{id}', [TaskController::class, 'update']);  
Route::delete('/deleteTask{id}', [TaskController::class, 'destroy']); 
