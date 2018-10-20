@extends('layouts.internal')
@section('PageTitle', 'Tune Stats')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Tunebook</h1>
    </div>
    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
                <div class="container">
                @foreach(['Gregor'=>$song_gregor,
                 'Michi'=>$song_michi,
                 'Günther'=>$song_guenther, 
                 'Reels' =>$tune_reels,
                 'Jigs'=>$tune_jigs,
                 'Slip Jigs' => $tune_slipjigs,
                 'Polkas' => $tune_polkas,
                 'Hornpipes' =>$tune_hornpipes,
                 'Sonstige' =>$tune_remainder,
                 'Tänzer Sets' =>$tune_dancer,
                 'Flagged as problematic'=>$flagged] as $heading=>$tunes)
                <h2>{{$heading}}</h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Song
                            </th>
                            <th>
                                Tuneset
                            </th>
                            <th>
                                Flag
                            </th>
                            <th>
                                Setlist Info
                            </th>

                        </thead>
                        <tbody>
                    @foreach($tunes as $index=>$tune)
                    @if($tune->has_tag("flag"))
                    <tr class="warning">
                        @else
                        @if(  count($tune->setlists->filter(function ($setlist){
                            return strcmp($setlist->konzert->start_t, date('Y-m-d'))>=0;})) >0)
                            <tr class="success">
                                @else
                    <tr>
                        @endif
                        @endif
                        <td> <!-- ID -->
                            {{$tune->id}}
                        </td>
                        <td> <!-- Name -->

                            <a href="{{url('/internal/tunes/'.$tune->id)}}">{{$tune->title == "" ? "namenloser tune" : $tune->title}}</a>
                        </td>
                        <td> <!-- Song -->
                            @if($tune->has_tag("song"))<span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                            @if($tune->has_tag("gregor"))
                                |Gr
                            @endif
                            @if($tune->has_tag("guenther"))
                            |Gu
                        @endif
                        @if($tune->has_tag("michi"))
                        |Mi
                    @endif
                    @endif
                        </td>
                        <td> <!-- Tuneset -->
                            @if(!($tune->has_tag("song")))<span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                    @if($tune->has_tag("tänzer"))
                    |💃
                @endif
                    @endif
                        </td>
                        <td> <!-- Flag -->
                            @if($tune->has_tag("flag"))
                            <span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                            @endif
                        </td>
                        <td> <!-- Setlists -->
                            
                                @if(($tune->setlists->count())==0)
                                <span class="color:red!;font-weight:bold!;">
                                @else
                                <span>
                                @endif
                                {{count($tune->setlists)}} Sl.
                                
                                </span>
                                @if(                                count($tune->setlists->filter(function ($setlist){
                                    return strcmp($setlist->konzert->start_t, date('Y-m-d'))>=0;}))
                                >0)
                                {{count($tune->setlists->filter(function ($setlist){
                                    return strcmp($setlist->konzert->start_t, date('Y-m-d'))>=0;}))
                                }} zukünftig.
                                @endif
                                @if(!$tune->last_used_within('+3 year'))
                        <b>&gt;3y</b>
                        @else
                        @if(!$tune->last_used_within('+2 year'))
                        <b>&gt;2y</b>
                        @else
                        @if(!$tune->last_used_within('+1 year'))
                        <b>&gt;1y</b>

                        @endif
                        @endif
               
                        @endif
                        </td>
                    </tr>
                    @endforeach
                        </tbody>
                </table>
@endforeach
                </div>
            </div>
    </main>

@endsection
