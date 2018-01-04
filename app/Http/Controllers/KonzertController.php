<?php

namespace App\Http\Controllers;


use App\Models\Konzerte;
use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
class KonzertController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {

        $jahre = Konzerte::all()->pluck('start_t')->all();
        $jahre = array_unique(array_map(function($j){
            return substr($j, 0, 4);
        }, $jahre));
        $konzerte = Konzerte::where('public', 'true')->orderBy('start_t', 'desc')->get();
        $private = Konzerte::where('public', 'false')->orderBy('start_t', 'desc')->get();

        if (null !== app('request')->input('jahr')){
            $konzerte = $konzerte->filter(function($kon){return substr($kon->start_t, 0, 4)== $_GET['jahr'];});
            $private = $private->filter(function($kon){return substr($kon->start_t, 0, 4)== $_GET['jahr'];});
        }
        return view('konzerte.index', ['jahre'=>$jahre, 'konzerte'=>$konzerte, 'private'=>$private]);
    }
    public function show($id){
        $konzert = Konzerte::find($id);
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.paddysreturn.com');
        $vEvent = new \Eluceo\iCal\Component\Event();


        $vEvent
            ->setDtStart(new \DateTime($konzert->start_t))
            ->setDtEnd(new \DateTime($konzert->end_t))
            ->setUseUtc(false)
            ->setSummary('Paddy’s Return: '.$konzert->title)
            ->setDescription('www.paddysreturn.com/konzerte/'.$konzert->id)
            ->setLocation($konzert->address.' '.$konzert->postal.' '.$konzert->city.' '.$konzert->country);
        $vCalendar->addComponent($vEvent);
        file_put_contents('files/shares/ical_'.$konzert->id.'.ics', $vCalendar->render());

        QrCode::format('svg')->encoding('UTF-8')
            ->generate($vCalendar->render(), 'photos/shares/qr_'.$konzert->id.'.svg');
        return view('konzerte.show', ['konzert'=>$konzert, 'vEvent'=>$vCalendar]);
    }
    public function create()
    {
        $konzert = new Konzerte;
        return view('konzerte.create', ['konzert'=>$konzert]);
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
            'place'=>'required',
            'address'=>'required',
            'city'=>'required' ,
            'region'=>'required',
            'postal'=>'required',
            'country'=>'required',
            'price'=>'required',
            'start_t'=>'required',
            'end_t'=>'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('internal/konzerte/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $konzert = new Konzerte;
            $konzert->title = Input::get('title');
            $konzert->dest = Input::get('dest');
            $konzert->place = Input::get('place');
            $konzert->address = Input::get('address');
            $konzert->plakat_file_name = Input::get('plakat_file_name');
            $konzert->placeurl = Input::get('placeurl');
            $konzert->city = Input::get('city');
            $konzert->region = Input::get('region');
            $konzert->postal = Input::get('postal');
            $konzert->country = Input::get('country');
            $konzert->price = Input::get('price');
            $konzert->photocredit = Input::get('photocredit');
            $konzert->start_t = Input::get('start_t');
            $konzert->end_t = Input::get('end_t');
            $konzert->dismaps = !!Input::get('dismaps');
            $konzert->pinned = !!Input::get('pinned');
            $konzert->hidden = !!Input::get('hidden');
            $konzert->public = !!Input::get('public');
            $konzert->band = Input::get('band');
            $konzert->save();
            // redirect
            Session::flash('message', 'Successfully updated Tune!');
            return Redirect::to('/internal/konzerte/'.$konzert->id);
        }
    }
    public  function edit($id){
        $konzert = Konzerte::find($id);
        return view('konzerte.edit', ['konzert'=>$konzert]);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'place'=>'required',
            'address'=>'required',
            'city'=>'required' ,
            'region'=>'required',
            'postal'=>'required',
            'country'=>'required',
            'price'=>'required',
            'start_t'=>'required',
            'end_t'=>'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/internal/konzerte/'.$id.'edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $konzert = Konzerte::find($id);
            $konzert->title = Input::get('title');
            $konzert->dest = Input::get('dest');
            $konzert->place = Input::get('place');
            $konzert->address = Input::get('address');
            $konzert->plakat_file_name = Input::get('plakat_file_name');
            $konzert->placeurl = Input::get('placeurl');
            $konzert->city = Input::get('city');
            $konzert->region = Input::get('region');
            $konzert->postal = Input::get('postal');
            $konzert->country = Input::get('country');
            $konzert->price = Input::get('price');
            $konzert->photocredit = Input::get('photocredit');
            $konzert->start_t = Input::get('start_t');
            $konzert->end_t = Input::get('end_t');
            $konzert->dismaps = !!Input::get('dismaps');
            $konzert->pinned = !!Input::get('pinned');
            $konzert->hidden = !!Input::get('hidden');
            $konzert->public = !!Input::get('public');
            $konzert->band = Input::get('band');
            $konzert->save();
            // redirect
            Session::flash('message', 'Successfully updated Tune!');
            return Redirect::to('/internal/konzerte/'.$konzert->id);
        }
    }
    public function destroy($id)
    {
        // delete
        $tune = Konzerte::find($id);
        $tune->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the tune!');
        return Redirect::to('internal/konzerte');
    }
}