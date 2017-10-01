@extends('layouts/app')
@section('PageTitle', 'Musik')
@section('description')
    Paddy’s Return - Liste unserer Aufnahmen.
@endsection
@section('content')
    <main class="main">
        <div class="page-title">
            <h2 class="text-center">Musik</h1>
        </div>


        <div class="fullwidth-block">
            @foreach($recordings as $key => $recording)
                @unless ( ($key % 2 == 0) && ($key == (count($recordings)-1)))
                    <div class="col-sm-6">
                        @else
                            <div class="col-sm-6 col-sm-offset-3">
                                @endunless
                                <div class="embed-responsive embed-responsive-4by3">
                                    <iframe class="embed-responsive-item" src="{{$recording->embed}}"
                                            allowfullscreen></iframe>

                                </div>
                            </div>
                    </div>
                    @endforeach
        </div>
    </main>
@endsection