<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned professor  the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('classes')->group(function () {
    Route::prefix('{id}')->group(function () {
        Route::prefix('documents')->group(function () {
            Route::get('{documentId}/files', 'ClassesDocumentController@viewFiles')->name('api.dashboard.classes.documents.files.list');
            Route::delete('{documentId}', 'ClassesDocumentController@delete')->name('api.dashboard.classes.documents.delete');
        });
    });
});
