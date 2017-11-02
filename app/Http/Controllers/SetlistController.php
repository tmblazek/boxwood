<?php

namespace App\Http\Controllers;

use App\Models\Konzerte;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Setlist;
use Log;
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
        if (null !== request('copy')){
            $setlist = Setlist::find(request('copy'));
            $konzert = $setlist->konzert->id;
        }elseif (null !== request('konzert')){
            $setlist = new Setlist;
            $konzert = Konzerte::find(\request('konzert'))->id;
        }else{
            $setlist = new Setlist;
            $konzert = null;
        }
        return view('setlists.create', ['setlist'=>$setlist, 'konzert'=>$konzert]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'setlist' => 'required',
            'konzert' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('setlists/new')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            Log::error(Input::get('konzert'));
            $konzert = Konzerte::find(Input::get('konzert'));
            Log::error($konzert->title);
            $setlist = new Setlist;
            $setlist->setlist = Input::get('setlist');
            $setlist->title = Input::get('title');
            $setlist->konzert()->dissociate();
            $setlist->konzert()->associate($konzert);
            $setlist->save();
            $setlist->sync_tunes();
            $setlist->save();
            Session::flash('message', 'Successfully updated Setlist!');
            return Redirect::to('internal/internal/setlists/'.$setlist->id);
        }
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
        $setlist = Setlist::find($id);
        $current_konzert = $setlist->konzert->id;
        return view('setlists.edit', ['setlist'=>$setlist, 'konzert'=>$current_konzert]);
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
        $rules = array(
            'title' => 'required',
            'setlist' => 'required',
            'konzert' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/setlists/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            Log::error(Input::get('konzert'));
            $konzert = Konzerte::find(Input::get('konzert'));
            Log::error($konzert->title);
            $setlist = Setlist::find($id);
            $setlist->setlist = Input::get('setlist');
            $setlist->title = Input::get('title');
            $setlist->konzert()->dissociate();
            $setlist->konzert()->associate($konzert);

            $setlist->sync_tunes();
            $setlist->save();
            Session::flash('message', 'Successfully updated Setlist!');
            return Redirect::to('internal/setlists/'.$id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tune = Setlist::find($id);
        $tune->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the tune!');
        return Redirect::to('internal/setlists');
    }
}
