<?php

namespace App\Http\Controllers;

use App\Models\Konzerte;
use App\Http\Controllers\Controller;

class KonzertController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $jahre = Konzerte::all()->pluck('start_t')->all();
        $jahre = array_unique(array_map(function($j){
            return substr($j, 0, 4);
        }, $jahre));
        $konzerte = Konzerte::where('public', 'true')->orderBy('start_t', 'desc')->get();
        if (null !== app('request')->input('jahr')){
            $konzerte = $konzerte->filter(function($kon){return substr($kon->start_t, 0, 4)== $_GET['jahr'];});
        }
        return view('konzerte_index', ['jahre'=>$jahre, 'konzerte'=>$konzerte]);
    }
    public function show($id){
        $konzert = Konzerte::where('id', '=', $id)->first();


        return view('konzerte', ['konzert'=>$konzert]);
    }
}