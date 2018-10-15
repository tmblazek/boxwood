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
                        <h3>{{$index}}: 
                            <a href="{{url('/internal/tunes/'.$tune->id)}}">{{$tune->title == "" ? "namenloser tune" : $tune->title}}</a>
                            | {{count($tune->setlists)}} Setl.
                        </h3>
                    @endforeach
                </div>
            </div>
    </main>

@endsection