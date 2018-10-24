<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
class PagesController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function infos()
    {
        $pages = Page::where('tags', '=', 'informationen')->get();
        return view('pages_index', ['pages'=>$pages]);
    }
    public function index()
    {
        $pages = Page::all();
        return view('pages_index', ['pages'=>$pages]);
    }
    public function show($id){
        $info = Page::find($id);
        return view('pages_show', ['info'=>$info]);
    }
}
