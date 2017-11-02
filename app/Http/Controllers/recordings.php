<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Recording;
class recordings extends Controller
{
    function index()
    {
        $recordings= Recording::all();
        return view('recording_index', ['recordings'=>$recordings]);
    }
    function create()
    {
        return view('/recordings/create');
    }
    function store()
    {
            // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'embed' => 'required',
            'order' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('recordings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $recording = new Recording;
            $recording->desc = Input::get('desc');
            $recording->title = Input::get('title');
            $recording->embed = Input::get('embed');
            $recording->order = Input::get('order');
            $recording->save();
            // redirect
            Session::flash('message', 'Successfully updated Recording!');
            return Redirect::to('recordings/');
        }
    }
    function show($id)
    {
        $recording = Recording::find($id);
        return view('recording', ['recording'=>$recording]);
    }
    function edit($id)
    {
        $rec = Recording::find($id);
        return view('recordings.edit', ['recording'=>$rec]);
    }
    function update($id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'embed' => 'required',
            'order' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('recordings/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $recording = Recording::find($id);
            $recording->desc = Input::get('desc');
            $recording->title = Input::get('title');
            $recording->embed = Input::get('embed');
            $recording->order = Input::get('order');
            $recording->save();
            // redirect
            Session::flash('message', 'Successfully updated Recording!');
            return Redirect::to('recordings/');
        }
    }
    function destroy($id){}

}
