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
use Illuminate\Support\Facades\Mail;
use App\Mail\DataUpdate;
use Log;
use App\Models\Tune;
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
            return Redirect::to('/internal/setlists/'.$setlist->id);
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
            $changes = array();
            $removals = array();
            $additions = array();
            $order_changes = array();
            $this->record_changes($setlist->setlist, Input::get('setlist'),
                $removals, $additions, $order_changes);

            $setlist->setlist = Input::get('setlist');
            $setlist->title = Input::get('title');
            $setlist->konzert()->dissociate();
            $setlist->konzert()->associate($konzert);

            $setlist->save();
            $setlist->sync_tunes();
            $setlist->save();
            if (strcmp($setlist->title, 'Endgültig') == 0){

                Mail::to(["wtblazek@gmail.com", "mist@gmx.at", "xandi.tichy@chello.at","gue.ha@aon.at", "gregor.loetsch@reflex.at"])->send(new DataUpdate($removals, $additions, $order_changes, $setlist->full_title(), "https://www.paddysreturn.com/internal/setlists/".$setlist->id));

            }
            Session::flash('message', 'Successfully updated Setlist!');
            return Redirect::to('internal/setlists/'.$id);
        }

    }
    private function record_changes($setlist_old, $setlist_new, &$removals, &$additions, &$order_changes)
    {
        $old_array = explode("|", substr($setlist_old, 1, -1));
        $new_array = explode("|", substr($setlist_new, 1, -1));
        foreach($old_array as $old){
            if (!in_array($old, $new_array))
                array_push($removals, $this->get_tune($old));
        }
        foreach($new_array as $new){
            if (!in_array($new, $old_array))
                array_push($additions, $this->get_tune($new));
        }

        foreach($old_array as $index=>$old){
            if (0 == strcmp($old, $new_array[$index]))
                continue;
            else
                array_push($order_changes, $this->get_tune($old));


        }
    }
    private function get_tune($string){
        return Tune::find(str_replace('tune', '', $string))->title;
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
