@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Edit {{$setlist->title}}</h1>
    </div>
    <main class="main">
        {{ Html::ul($errors->all()) }}
        {{ Form::model($setlist, array('route' => array('setlists.update', $setlist->id), 'method' => 'PUT')) }}
        {{ Form::submit('Edit the Setlist!', array('class' => 'btn btn-primary')) }}
        @component('setlists.form', ['setlist'=>$setlist])
        @endcomponent
        {{ Form::close() }}
    </main>
    @endsection
