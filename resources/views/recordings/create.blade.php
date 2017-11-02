@extends('layouts/internal')
    @section('content')
    <div class="page-title">
    <h1 class="text-center">Neues Recording</h1>
    </div>
    <main class="main">
    <div class="fullwidth-block">
    <div class=" container">
{{ Html::ul($errors->all()) }}


        {{ Form::open(array('url' => '/recordings')) }}

    @component('recordings.form')
        @endcomponent
    {{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
</div>
</div>
</main>
@endsection
