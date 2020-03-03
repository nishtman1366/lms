<?php

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

Route::get('/', function () {
    return view('home');
});
Route::post('search', 'HomeController@searchResults')->name('search');
Route::get('documents/{id}', 'HomeController@viewDocument')->name('view_document');
Route::get('{id}/download', 'FileController@download')->name('download');
Auth::routes();

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('', 'DashboardController@index')->name('dashboard');
    Route::prefix('documents')->group(function () {
        Route::get('', 'DocumentController@index')->name('dashboard.documents.list');

        Route::get('new', 'DocumentController@form')->name('dashboard.documents.new');
        Route::post('', 'DocumentController@create')->name('dashboard.documents.create');

        Route::get('{id}/edit', 'DocumentController@form')->name('dashboard.documents.edit');
        Route::post('{id}', 'DocumentController@update')->name('dashboard.documents.update');

        Route::get('{id}/delete', 'DocumentController@delete')->name('dashboard.documents.delete');

        Route::get('{id}/files', 'FileController@viewByDocument')->name('dashboard.documents.view_files');
    });

    Route::prefix('professors')->group(function () {
        Route::get('', 'ProfessorController@index')->name('dashboard.professors.list');
        Route::get('{id}/documents', 'DocumentController@viewByProfessor')->name('dashboard.professors.view_documents');
        Route::get('{id}/classes','ProfessorController@classes')->name('dashboard.professors.view_classes');
        Route::get('new', 'ProfessorController@form')->name('dashboard.professors.new');
        Route::post('', 'ProfessorController@create')->name('dashboard.professors.create');

        Route::get('{id}/edit', 'ProfessorController@form')->name('dashboard.professors.edit');
        Route::post('{id}', 'ProfessorController@update')->name('dashboard.professors.update');

        Route::get('{id}/delete', 'ProfessorController@delete')->name('dashboard.professors.delete');
    });

    Route::prefix('lessons')->group(function () {
        Route::get('', 'LessonController@index')->name('dashboard.lessons.list');
        Route::get('{id}/documents', 'DocumentController@viewByLesson')->name('dashboard.lessons.view_documents');
        Route::get('{id}/classes','LessonController@classes')->name('dashboard.lessons.view_classes');

        Route::get('new', 'LessonController@form')->name('dashboard.lessons.new');
        Route::post('', 'LessonController@create')->name('dashboard.lessons.create');

        Route::get('{id}/edit', 'LessonController@form')->name('dashboard.lessons.edit');
        Route::post('{id}', 'LessonController@update')->name('dashboard.lessons.update');

        Route::get('{id}/delete', 'LessonController@delete')->name('dashboard.lessons.delete');
    });

    Route::prefix('classes')->group(function () {
        Route::get('', 'ClassController@index')->name('dashboard.classes.list');

        Route::get('{id}/students', 'StudentController@index')->name('dashboard.classes.view_students');
        Route::post('{id}/students', 'StudentController@addStudents')->name('dashboard.classes.add_students');
        Route::delete('{id}/students', 'StudentController@deleteStudents')->name('dashboard.classes.add_students');

        Route::get('new', 'ClassController@form')->name('dashboard.classes.new');
        Route::post('', 'ClassController@create')->name('dashboard.classes.create');

        Route::get('{id}/edit', 'ClassController@form')->name('dashboard.classes.edit');
        Route::post('{id}', 'ClassController@update')->name('dashboard.classes.update');

        Route::get('{id}/delete', 'ClassController@delete')->name('dashboard.classes.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('', 'UserController@index')->name('dashboard.users.list');
    });
});
