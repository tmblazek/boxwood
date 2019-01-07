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
        @foreach($konzerte as $k)
        <div>{{$k->title}}: {{null ===$k->setlist ? "<a href=\"/internal/setlists/create?konzerte=".$k->id."\">"Keine Setlist Vorhanden, neue erstellen</a>": "<a href=\"/internal/setlists/".$k->setlist->id."\">".$k->setlist->title."</a>"}}</div>
        @endforeach
      </div>
      <div class="col-sm-6">
        @foreach($tunes as $t)
        <div><a href="/internal/tunes/{{$t->id}}">{{$t->title}}: {{$t->updated_at}}</a></div>
        @endforeach
      </div>
    </div>
  </div>
</main>
@endsection
