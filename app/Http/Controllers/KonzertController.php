<?php

namespace App\Http\Controllers;

use App\Models\Konzerte;
use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
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
        $vEvent = new \Eluceo\iCal\Component\Event();
        $vEvent->setDtStart(new \DateTime($konzert->start_t))->setDtEnd(new \DateTime($konzert->end_t))->setSummary($konzert->title)
            ->setLocation($konzert->address.' '.$konzert->postal.' '.$konzert->city.' '.$konzert->country);
        QrCode::size(2000)->encoding('UTF-8')->format('png')->generate($vEvent->render(), 'photos/shares/qr_'.$konzert->id.'.png');
        return view('konzerte.show', ['konzert'=>$konzert, 'vEvent'=>$vEvent]);
    }
}