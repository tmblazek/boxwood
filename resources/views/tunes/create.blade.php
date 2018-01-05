@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Neuer Tune</h1>
    </div>
    <main class="main">
        {{ Html::ul($errors->all()) }}


        {{ Form::open(array('url' => '/internal/tunes')) }}
        {{ Form::submit('New Tune!', array('class' => 'btn btn-primary')) }}
        @component('tunes.form', ['taggings' =>$taggings])
        @endcomponent
        {{ Form::close() }}
    </main>
@endsection
