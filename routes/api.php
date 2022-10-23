<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\userC;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// register And Login
Route::post('/Registration',[userC::class,'signup']);
Route::post('/login',[userC::class,'login']);


//Complete Protected Route
Route::middleware(['auth:sanctum'])->group(function(){

    //To Manipulate show,deletebyID,search
    Route::get('/student',[StudentController::class,'index']);
    Route::get('/student/{id}',[StudentController::class,'showid']);
    Route::get('/deletestudent/{id}',[StudentController::class,'deletebyID']);
    Route::get('/search/{city}',[StudentController::class,'searchbyCity']);

    // logout
    Route::get('/logout',[userC::class,'logout']);

    //Create And Update Students
    Route::post('/createstudent',[StudentController::class,'addstudent']);
    Route::post('/createstudent/{id}',[StudentController::class,'updatebyID']);


});
