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
    $announcements = DB::table('announcements')->where('public','=', 'true')->where('pub_start', '<=', date('Y-m-d'))->where('pub_end', '>=', date('Y-m-d'))->get();
	$konzerte = DB::table('konzerte')->where('public', 'true')->where('hidden', 'false')->where('start_t', '>=', date('Y-m-d') )->orderBy('start_t', 'asc')->take(3);
    return view('welcome', ['konzerte' => $konzerte->get(), 'body_class'=>'header-collapse', 'announcements'=>$announcements, 'band_bio'=>$band_bio]);
});
Route::get('/stpatricksnight', function () {
   $blog = DB::table('pages')->where('id', 14)->first();
   //$blog->content = emails_html_safe($blog->content);
   $body_class = "";
   return view('info', ['page'=> $blog]);
});
Route::get('foo', 'Photos\AdminController@method');
Route::get('/konzerte', 'KonzertController@index');
Route::get('/konzerte/{id}', 'KonzertController@show');
