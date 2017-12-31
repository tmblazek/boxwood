<?php

namespace App\Http\Controllers;

use App\Models\Konzerte;
use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        if (null !== app('request')->input('jahr')){
            $konzerte = $konzerte->filter(function($kon){return substr($kon->start_t, 0, 4)== $_GET['jahr'];});
        }
        return view('konzerte.index', ['jahre'=>$jahre, 'konzerte'=>$konzerte]);
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
}