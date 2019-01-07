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
Route::get('/presse', function (){
    return view('presse', ['test'=>'test']);
});
Route::get('/stpatricksnight', function (){
    return view('stpatricksnight2019', ['test'=>'test']);
});
Route::get('/', function () {
    $band_bio = DB::table('biographies')->where('frontpage', 'true')->first();
    $recordings = DB::table('recordings')->where('order', '>', '0')->get();
    $announcements = DB::table('announcements')->where('public','=', 'true')->where('pub_start', '<=', date('Y-m-d'))->where('pub_end', '>=', date('Y-m-d'))->get();
	$konzerte = DB::table('konzerte')->where('public', 'true')->where('hidden', 'false')->where('start_t', '>=', date('Y-m-d') )->orderBy('start_t', 'asc')->take(5);
    return view('welcome', ['konzerte' => $konzerte->get(), 'body_class'=>'header-collapse', 'announcements'=>$announcements, 'band_bio'=>$band_bio, 'recordings'=>$recordings]);
});
/*Route::get('/stpatricksnight', function () {
   $blog = DB::table('pages')->where('id', 14)->first();
   //$blog->content = emails_html_safe($blog->content);
   $body_class = "";
   return view('pages_show', ['page'=> $blog]);
   });*/
Route::get('foo', 'Photos\AdminController@method');
Route::get('/musik', 'recordings@index');
Route::get('/musik/{id}', 'recordings@show');
Route::get('/informationen', 'PagesController@infos');
Route::get('/pages/{id}', 'PagesController@show');
Route::get('/band', 'BiographiesController@band');

Auth::routes();
Route::resource('/konzerte', 'KonzertController', ['only'=>['index', 'show']]);
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth', 'clearance'])->group(function () {
    Route::resource('recordings', 'recordings');

        Route::get('/internal/', function () {
            $tunes = DB::table('tunes')->orderBy('updated_at', 'desc')->take(10)->get();
            $konzerte = Konzerte::where('start_t', '>=', date('Y-m-d') )->orderBy('start_t', 'asc')->get();
                      
            return view('internal_welcome', ['konzerte'=>$konzerte, 'tunes'=>$tunes]);
    });
    Route::resource('/internal/konzerte', 'KonzertController');
    Route::resource('/internal/pages', 'PagesController');
    Route::resource('/internal/users', 'UserController');
    Route::resource('/internal/announcements', 'AnnouncementController');
    Route::resource('/internal/tunes', 'TuneController');
    Route::get('/internal/tunestats', 'TuneController@stats');
    Route::resource('/internal/setlists', 'SetlistController');
    Route::get('/internal/setlists/{id}/druckvorschau', 'SetlistController@druckvorschau');
    Route::get('/internal/setlists/{id}/michi', 'SetlistController@michi');
    Route::get('/internal/tunebook', 'TuneController@tunebook');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
    // list all lfm routes here...
});
