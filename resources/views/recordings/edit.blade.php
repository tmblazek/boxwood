@extends('layouts/internal')
    @section('content')
    <div class="page-title">
    <h1 class="text-center">Edit {{$recording->title}}</h1>
</div>
<main class="main">
    <div class="fullwidth-block">
    <div class=" container">
    {{ Html::ul($errors->all()) }}

        {{ Form::model($recording, array('route' => array('recordings.update', $recording->id), 'method' => 'PUT')) }}

    @component('recordings.form', ['recording'=>$recording])
        @endcomponent
    {{ Form::submit('Speichern!', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
</div>
</div>
</main>
@endsection
