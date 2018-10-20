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
            $tunes = Tune::find_by_tag_string(app('request')->input('tag'))->sortBy('title');
        }
        else
        {$tunes = Tune::all()->sortBy('title');}
        if  (null!== app('request')->input('exclude_tag')){
            $remove_tag = Tune::find_by_tag_string(app('request')->input('exclude_tag'))->sortBy('title');
            $tunes = $tunes->diff($remove_tag);
        
        }
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
        $tunes = Tune::find_by_tag_string(app('request')->input('tag'))->sortBy('title');
        if ('true'!=app('request')->input('michi')){
        return view('tunes.druckvorschau', ['tunes'=>$tunes, 'title'=>$title]);
        }
        else{
            return view('tunes.michi_druckvorschau', ['tunes'=>$tunes, 'title'=>$title]);
        }
    }
    public function stats()
    {
        $tunes_to_exclude =Tune::find_by_tag_string('flag');
        $song_gregor = Tune::find_by_tag_string('gregor')->diff($tunes_to_exclude);
        $song_michi = Tune::find_by_tag_string('michi')->diff($tunes_to_exclude);
        $song_guenther = Tune::find_by_tag_string('guenther')->diff($tunes_to_exclude);
        $tune_dancer = Tune::find_by_tag_string('tänzer')->diff($tunes_to_exclude);
        $tune_reels = Tune::find_by_tag_string('reels')->diff($tunes_to_exclude);
        $tune_jigs = Tune::find_by_tag_string('jigs')->diff($tunes_to_exclude);
        $tune_polkas = Tune::find_by_tag_string('polkas')->diff($tunes_to_exclude);
        $tune_hornpipes = Tune::find_by_tag_string('hornpipes')->diff($tunes_to_exclude);
        $tune_slipjigs = Tune::find_by_tag_string('slipjigs')->diff($tunes_to_exclude);
        $tune_remainder = Tune::all()->diff($tune_slipjigs)
        ->diff($tune_jigs)
        ->diff($tune_polkas)
        ->diff($tune_hornpipes)
        ->diff($tune_reels)
        ->diff($tune_dancer)
        ->diff($song_gregor)
        ->diff($song_michi)
        ->diff($tune_guenther);
        return view('tunes.tunestats', 
            ['flagged'=>$tunes_to_exclude,
             'song_gregor'=>$song_gregor,
             'song_michi'=>$song_michi,
             'song_guenther'=>$song_guenther,
             'tune_dancer'=>$tune_dancer,
             'tune_reels'=>$tune_reels,
             'tune_jigs'=>$tune_jigs, 
             'tune_polkas'=>$tune_polkas,
             'tune_hornpipes'=>$tune_hornpipes,
             'tune_slipjigs'=>$tune_slipjigs, 
             'tune_remainder'=>$tune_remainder 
            ]);
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
