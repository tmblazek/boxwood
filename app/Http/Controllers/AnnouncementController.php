<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;
use App\Models\Announcement;
class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('announcements.index', ['announcements'=> $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'pub_start' => 'required',
            'pub_end' => 'required',
            'link' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/announcements/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $announcement = new Announcement;
            $announcement->message = Input::get('message');
            $announcement->title = Input::get('title');
            $announcement->pub_start = Input::get('pub_start');
            $announcement->pub_end = Input::get('pub_end');
            $announcement->text = Input::get('text');
            $announcement->link = Input::get('link');
            $announcement->public = Input::get('public');
            $announcement->photo_file_name = Input::get('photo_file_name');
            $announcement->save();
            // redirect
            Session::flash('message', 'Successfully updated Announcement!');
            return Redirect::to('internal/announcements/');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ann = Announcement::find($id);
        return view('announcements.edit', ['announcement'=>$ann]);
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'pub_start' => 'required',
            'pub_end' => 'required',
            'text' => 'required',
            'link' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/announcements/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $announcement = Announcement::find($id);
            $announcement->message = Input::get('message');
            $announcement->title = Input::get('title');
            $announcement->pub_start = Input::get('pub_start');
            $announcement->pub_end = Input::get('pub_end');
            $announcement->text = Input::get('text');
            $announcement->public = Input::get('public');
            $announcement->link = Input::get('link');
            $announcement->photo_file_name = Input::get('photo_file_name');
            $announcement->save();
            // redirect
            Session::flash('message', 'Successfully updated Announcement!');
            return Redirect::to('internal/announcements/');
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
        //
    }
}
