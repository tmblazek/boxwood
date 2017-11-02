@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Neue Ankündigung</h1>
    </div>
    <main class="main">
        <div class="fullwidth-block">
            <div class=" container">
        {{ Html::ul($errors->all()) }}


        {{ Form::open(array('url' => '/internal/announcements')) }}

        @component('announcements.form')
        @endcomponent
        {{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
            </div>
        </div>
    </main>
@endsection
