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
//function emails_html_safe($in_string)
//{
//    $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
//    preg_match_all($pattern, $in_string, $matches);
//    if (count($matches) == 0)
//        return $in_string;
//    foreach($matches as $match){
//        if (count($match)==0)
//            continue;
//        str_replace($match[0], Html::mailto($match[0]), $in_string);
//    }
//    return $in_string;
//}
Route::get('/', function () {
    $band_bio = DB::table('biographies')->where('frontpage', 'true')->first();
    $recordings = DB::table('recordings')->get();
    $announcements = DB::table('announcements')->where('public','=', 'true')->where('pub_start', '<=', date('Y-m-d'))->where('pub_end', '>=', date('Y-m-d'))->get();
	$konzerte = DB::table('konzerte')->where('public', 'true')->where('hidden', 'false')->where('start_t', '>=', date('Y-m-d') )->orderBy('start_t', 'asc')->take(3);
    return view('welcome', ['konzerte' => $konzerte->get(), 'body_class'=>'header-collapse', 'announcements'=>$announcements, 'band_bio'=>$band_bio, 'recordings'=>$recordings]);
});
Route::get('/stpatricksnight', function () {
   $blog = DB::table('pages')->where('id', 14)->first();
   //$blog->content = emails_html_safe($blog->content);
   $body_class = "";
   return view('pages_show', ['page'=> $blog]);
});
Route::get('foo', 'Photos\AdminController@method');
Route::get('/konzerte', 'KonzertController@index');
Route::get('/konzerte/{id}', 'KonzertController@show');
Route::get('/musik', 'recordings@index');
Route::get('/musik/{id}', 'recordings@show');
Route::get('/informationen', 'PagesController@index');
Route::get('/pages/{id}', 'PagesController@show');
Route::get('/band', 'BiographiesController@band');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'clearance'])->group(function () {
    Route::get('/internal/tunes', 'TuneController@index');
    Route::get('/internal/tunes/{id}', 'TuneController@show');
    Route::get('/internal/setlists', 'SetlistController@index');
    Route::get('/internal/setlists/{id}', 'SetlistController@show');
    Route::get('/internal/setlists/{id}/druckvorschau', 'SetlistController@druckvorschau');
    Route::get('/internal/setlists/{id}/michi', 'SetlistController@michi');
});
