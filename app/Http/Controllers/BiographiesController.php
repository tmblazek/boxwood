<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biography;
class BiographiesController extends Controller
{
    function band(){
        $band = Biography::where('frontpage', 'true')->first();
        $members = Biography::where('frontpage', '=','false')->get();
        return view('band', ['band_bio'=>$band, 'member_bios'=>$members]);
    }
}
