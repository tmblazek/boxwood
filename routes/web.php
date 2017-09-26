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

	$konzerte = DB::table('konzerte')->where('start_t', '>=', date('Y-m-d') )->orderBy('start_t', 'asc')->take(3);
    return view('welcome', ['konzerte' => $konzerte->get(), 'body_class'=>'header-collapse']);
});
