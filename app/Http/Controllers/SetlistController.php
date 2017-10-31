<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setlist;
class SetlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setlists = Setlist::all()->sortByDesc(function ($item) {return $item->konzert->start_t;});
        return view('setlists.index', ['setlists' => $setlists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setlist = Setlist::find($id);
        return view("setlists.show", ['setlist'=>$setlist]);
    }
    public function druckvorschau($id){
        $setlist = Setlist::find($id);
        return view("setlists.druckvorschau", ['setlist'=>$setlist]);
    }
    public function michi($id){
        $setlist = Setlist::find($id);
        return view("setlists.michi_druckvorschau", ['setlist'=>$setlist]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $setlist = Setlist::find($id)
        //return view('setlists.edit', ['setlist'=>$setlist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
