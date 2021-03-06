@extends('layouts/internal')
@section('PageTitle', 'Übersicht')
@section('description')
Paddy’s Return - Pure Irish Folk Music in Wien!
@endsection
@section('content')
<div class="page-title">
  <h1 class="text-center">Interne Übersicht</h1>
</div>
<main class="main">

  <div class="fullwidth-block">
    <div class="container">
      <div class="col-sm-6">
        <h2> Zukünftige Konzerte </h2>
        @foreach($konzerte as $k)
        <p>{{$k->start_t}}: <a href="/konzerte/{{$k->id}}">{{$k->title}}</a> <br>
          Setlist: {!! null ===$k->setlist ? '<a href="/internal/setlists/create?konzerte='.$k->id.'">Keine Setlist Vorhanden, neue erstellen</a>': '<a href="/internal/setlists/'.$k->setlist->id.'">'.$k->setlist->title."</a>" !!} </p>
        @endforeach
 </div>    
<div class="col-sm-6">
  <h2> Die 10 zuletzt geänderten Tunes</h2>
        @foreach($tunes as $t)
        <p><a href="/internal/tunes/{{$t->id}}">{{$t->title}}: {{$t->updated_at}}</a></p>
        @endforeach
      </div>
    </div>
  </div>
</main>
@endsection
