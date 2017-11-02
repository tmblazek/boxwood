@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Edit {{$setlist->title}}</h1>
    </div>
    <main class="main">
        {{ Html::ul($errors->all()) }}
        {{ Form::model($setlist, array('route' => array('setlists.update', $setlist->id), 'method' => 'PUT')) }}
        {{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}
        @component('setlists.form', ['setlist'=>$setlist->setlist, 'title'=>$setlist->title, 'konzert'=>$konzert])
        @endcomponent
        {{ Form::close() }}
    </main>
    @endsection
