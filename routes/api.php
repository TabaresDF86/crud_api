<?php

use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group( ['middleware' => ["auth:sanctum"]], function(){
    //rutas autorización
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);

    //rutas tareas
    Route::post("create-task", [TaskController::class, "createTask"]);
    Route::get("check-task", [TaskController::class, "checkTask"]);
    Route::put("update-task/{id}", [TaskController::class, "updateTask"]);
    Route::delete("delete-task/{id}", [TaskController::class, "deleteTask"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
