@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Edit {{$konzert->title}}</h1>
    </div>
    <main class="main">
        <div class="fullwidth-block">
            <div class=" container">
        {{ Html::ul($errors->all()) }}

        {{ Form::model($konzert, array('route' => array('konzerte.update', $konzert->id), 'method' => 'PUT')) }}

        @component('konzerte.form', ['konzert'=>$konzert])
        @endcomponent
        {{ Form::submit('Speichern!', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
            </div>
        </div>
    </main>
@endsection
