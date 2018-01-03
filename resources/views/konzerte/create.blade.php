@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Neues Konzert</h1>
    </div>
    <main class="main">
        <div class="fullwidth-block">
            <div class=" container">
        {{ Html::ul($errors->all()) }}


        {{ Form::open(array('url' => '/internal/konzerte')) }}

        @component('konzerte.form')
        @endcomponent
        {{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
            </div>
        </div>
    </main>
@endsection
