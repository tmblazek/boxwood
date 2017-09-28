<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recording;
class recordings extends Controller
{
    function index()
    {
        $recordings= Recording::all();
        return view('recording_index', ['recordings'=>$recordings]);
    }
    function show($id)
    {
        $recording = Recording::find($id);
        return view('recording', ['recording'=>$recording]);
    }
}
