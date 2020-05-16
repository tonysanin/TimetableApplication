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
    return view('welcome');
});

// Universities
Route::get('/university/{api}', 'ApiController@get_university');
Route::get('/university/create/{api}/{full_name}/{short_name}', 'ApiController@create_university');
Route::get('/university/delete/{api}', 'ApiController@delete_university');
Route::get('/university/rename/{api}/{full_name}/{short_name}', 'ApiController@rename_university');

// Faculties
Route::get('/faculties/{api}', 'ApiController@get_faculties');
Route::get('/faculty/create/{api}/{full_name}/{short_name}', 'ApiController@create_faculty');
Route::get('/faculty/delete/{api}/{id}', 'ApiController@delete_faculty');
Route::get('/faculty/rename/{api}/{id}/{full_name}/{short_name}', 'ApiController@rename_faculty');

// Departments
Route::get('/department/{api}', 'ApiController@get_departments');
Route::get('/department/create/{api}/{faculty_id}/{full_name}/{short_name}', 'ApiController@create_department');
Route::get('/department/delete/{api}/{id}', 'ApiController@delete_department');
Route::get('/department/rename/{api}/{id}/{full_name}/{short_name}', 'ApiController@rename_department');

// Types
Route::get('/types/{api}', 'ApiController@get_types');
Route::get('/type/create/{api}/{full_name}/{short_name}', 'ApiController@create_type');
Route::get('/type/delete/{api}/{id}', 'ApiController@delete_type');
Route::get('/type/rename/{api}/{id}/{full_name}/{short_name}', 'ApiController@rename_type');

// Auditories
Route::get('/auditory/create/{api}/{name}', 'ApiController@create_auditory');
Route::get('/auditories/{api}', 'ApiController@get_auditories');
Route::get('/auditory/delete/{api}/{id}', 'ApiController@delete_auditory');
Route::get('/auditory/rename/{api}/{id}/{name}', 'ApiController@rename_auditory');

// Teachers
Route::get('/teachers/{api}', 'ApiController@get_teachers');
Route::get('/teacher/create/{api}/{full_name}/{short_name}/{department_id}', 'ApiController@create_teacher');
Route::get('/teacher/delete/{api}/{id}', 'ApiController@delete_teacher');
Route::get('/teacher/rename/{api}/{id}/{full_name}/{short_name}', 'ApiController@rename_teacher');

// Class Time
Route::get('/time/{api}', 'ApiController@get_time');
Route::get('/time/create/{api}/{time_start}/{time_end}', 'ApiController@create_time');
Route::get('/time/delete/{api}/{id}', 'ApiController@delete_time');

// Groups
Route::get('/groups/{api}', 'ApiController@get_groups');
Route::get('/group/create/{api}/{name}/{faculty_id}', 'ApiController@create_group');
Route::get('/group/delete/{api}/{id}', 'ApiController@delete_group');
Route::get('/group/rename/{api}/{id}/{name}', 'ApiController@rename_group');

// Subjects
Route::get('/subjects/{api}', 'ApiController@get_subjects');
Route::get('/subject/create/{api}/{full_name}/{short_name}', 'ApiController@create_subject');
Route::get('/subject/delete/{api}/{id}', 'ApiController@delete_subject');
Route::get('/subject/rename/{api}/{id}/{full_name}/{short_name}', 'ApiController@rename_subject');

// Classes
Route::get('/classes/{api}', 'ApiController@get_classes');
Route::get('/class/create/{api}/{subject_id}/{auditory_id}/{class_time_id}/{group_id}/{teacher_id}/{type_id}/{date}', 'ApiController@create_class');
Route::get('/class/delete/{api}/{id}', 'ApiController@delete_class');
