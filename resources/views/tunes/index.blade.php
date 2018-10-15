@extends('layouts.internal')
@section('PageTitle', 'Tunebook')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Tunebook</h1>
    </div>
    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
                <div class="row-fluid text-right">
                    <div class="btn-group" role="group">
                        {{Html::linkAction('TuneController@create', 'Neuer Tune', [], ['class'=>'btn btn-primary'])}}
                    </div>
                </div>

                <div class="container">
                    <p><b>Tunebook Generieren: </b>
                        <a href="{{url('/internal/tunebook?tag='.app('request')->input('tag'))}}">Als Tunebook Anzeigen</a> |   <a href="{{url('/internal/tunebook?michi=true&tag='.app('request')->input('tag'))}}">Als Tunebook Anzeigen (Michi)</a>
                    </p>

                    <p><b>Filter By:</b>
                    <a href="{{url('/internal/tunes')}}">Alle Tunes </a>|
                    @foreach(App\Models\Tag::all() as $tag)
                        <a href="{{url('/internal/tunes?tag='.$tag->name)}}">{{$tag->name}}</a> |
                    @endforeach
                    </p>
                    @foreach($tunes as $index=>$tune)
                        <h4>
                        @if($tune->has_tag("flag"))
                            <span style="color:red;">
                            @else
                            @if (                           count($tune->setlists->filter(function ($setlist){
                                return strcmp($setlist->konzert->start_t, date('Y-m-d'))>=0;}) >0))
                            <span class="font-weight:bold;">
                            @else
                            <span>
                            @endif
                            <a href="{{url('/internal/tunes/'.$tune->id)}}">{{$tune->title == "" ? "namenloser tune" : $tune->title}}</a>
                            | {{count($tune->setlists)}} Setl. gesamt.  
                            {{
                            count($tune->setlists->filter(function ($setlist){
                                return strcmp($setlist->konzert->start_t, date('Y-m-d'))>=0;}))
                            }} zukünftig.


                            </span>

                        </h4>
                    @endforeach
                    {{ date('Y-m-d')}}
                    Total: {{count($tunes)}}
                </div>
            </div>
    </main>

@endsection