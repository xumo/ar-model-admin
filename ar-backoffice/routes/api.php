<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\API\SubjectApiController;
use App\Http\Controllers\API\UserApiController;





Route::group(['namespace' => ' API'], function () {

    // Auth
    Route::post('/login', [UserApiController::class,'login']);
    // App
    Route::group(['middleware' => ['auth:api']], function () {

        // Get Subject list
        //Route::get('/v1/subjects', [SubjectApiController::class, 'getSubjects'] );
        //Route::post('/v1/subjects', [SubjectApiController::class, 'getSubjects'] )
 //       ->middleware('can:list_subjects');
//
        // Get subject info
        //Route::post('/v1/subjects/{uuid}', [SubjectApiController::class, 'getSubject'] )
  //      ->middleware('can:list_subjects');
        //Route::post('/v1/subject', [SubjectApiController::class, 'getSubject'] )
//        ->middleware('can:list_subjects');


    });

});
