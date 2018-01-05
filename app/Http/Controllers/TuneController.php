<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



use Illuminate\Http\Request;
use App\Models\Tune;
class TuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (null!== app('request')->input('tag')){
            $tunes = Tune::find_by_tags(app('request')->input('tag'))->sortBy('title');
        }
        else
        {$tunes = Tune::all()->sortBy('title');}

        return view('tunes.index', ['tunes'=>$tunes]);
    }
    public function tunebook()
    {
        if (null ===app('request')->input('tag')){
            $title = 'Tunebook';
        }
        else{
            $title = strtoupper(app('request')->input('tag'));
        }
        $tunes = Tune::find_by_tags(app('request')->input('tag'))->sortBy('title');
        if ('true'!=app('request')->input('michi')){
        return view('tunes.druckvorschau', ['tunes'=>$tunes, 'title'=>$title]);
        }
        else{
            return view('tunes.michi_druckvorschau', ['tunes'=>$tunes, 'title'=>$title]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tune = new Tune;
        return view('tunes.create', ['tune'=>$tune, 'taggings'=>'']);
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
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/tunes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $tune = new Tune;
            $tune->abc = Input::get('abc');
            $tune->title = Input::get('title');
            $tune->general_notes = Input::get('general_notes');
            $tune->status = Input::get('status');
            $tune->songtext = Input::get('songtext');
            $tune->tonart = Input::get('tonart');
            $tune->typ = Input::get('typ');
            $tune->michi = Input::get('michi');
            $tune->save();
            // redirect
            Session::flash('message', 'Successfully updated Tune!');
            return Redirect::to('internal/tunes/'.$tune->$id);
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
        $tune = Tune::find($id);
        return view("tunes.show", ['tune'=> $tune]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tune = Tune::find($id);
        $taggings = $tune->get_tags()->map(function ($it) {return $it->name;} )->implode(';');
        // show the edit form and pass the nerd
        return view('tunes.edit', ['tune'=> $tune, 'taggings'=>$taggings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responses
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/tunes/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $tune = Tune::find($id);
            $tune->abc = Input::get('abc');
            $tune->title = Input::get('title');
            $tune->general_notes = Input::get('general_notes');
            $tune->status = Input::get('status');
            $tune->songtext = Input::get('songtext');
            $tune->tonart = Input::get('tonart');
            $tune->typ = Input::get('typ');
            $tune->michi = Input::get('michi');
            $tune->save();
            $tune->set_new_tags(explode(";", trim(Input::get('taggings'))));
            // redirect
            Session::flash('message', 'Successfully updated Tune!');
            return Redirect::to('internal/tunes/'.$id);
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
        // delete
        $tune = Tune::find($id);
        $tune->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the tune!');
        return Redirect::to('internal/tunes');
    }
}
