@extends('layouts/internal')
@section('PageTitle', 'Setlists')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Setlists</h1>
    </div>
    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
@foreach($setlists as $setlist)
<h3>
   <a href="/internal/setlists/{{$setlist->id}}">{{$setlist->konzert->start_t}}: {{$setlist->full_title()}}</a>
</h3>


@endforeach
            </div>
        </div>
    </main>
    @endsection