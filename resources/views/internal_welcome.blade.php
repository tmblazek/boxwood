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
        <div>{{$k->title}}: {{null===$k->setlist ? "Keine Setlist Vorhanden" : "Setlist Vorhanden" }}
        @endforeach
      </div>
      <div class="col-sm-6">
        @foreach($tunes as $t)
        <div>{{$t->name}}: {{$t->updated_at}}</div>
        @endforeach
      </div>
    </div>
  </div>
</main>
@endsection
