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
                    @foreach($tunes as $tune)
                        <h3>
                            <a href="{{url('/internal/tunes/'.$tune->id)}}">{{$tune->title == "" ? "namenloser tune" : $tune->title}}</a>
                            | {{count($tune->setlists)}} Setl.
                        </h3>
                    @endforeach
                </div>
            </div>
    </main>

@endsection