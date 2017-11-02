@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Edit {{$announcement->title}}</h1>
    </div>
    <main class="main">
        <div class="fullwidth-block">
            <div class=" container">
        {{ Html::ul($errors->all()) }}

        {{ Form::model($announcement, array('route' => array('announcements.update', $announcement->id), 'method' => 'PUT')) }}

        @component('announcements.form', ['announcement'=>$announcement])
        @endcomponent
        {{ Form::submit('Speichern!', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
            </div>
        </div>
    </main>
@endsection
