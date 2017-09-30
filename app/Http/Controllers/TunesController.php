<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tune;
class TunesController extends Controller
{
    function index(){
        return view('tune_index', ['tunes'=>Tune::all()]);
    }
}
