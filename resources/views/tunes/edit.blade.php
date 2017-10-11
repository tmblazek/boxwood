@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Edit {{$tune->title}}</h1>
    </div>
    <main class="main">
        {{ Html::ul($errors->all()) }}

        {{ Form::model($tune, array('route' => array('tunes.update', $tune->id), 'method' => 'PUT')) }}
        {{ Form::submit('Edit the Tune!', array('class' => 'btn btn-primary')) }}
@component('tunes.form', ['tune'=>$tune])
    @endcomponent
        {{ Form::close() }}
    </main>
    @endsection
