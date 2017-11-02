@extends('layouts/internal')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Neue Setlist</h1>
    </div>
    <main class="main">
        {{ Html::ul($errors->all()) }}
        {{ Form::open(array('url' => '/internal/setlists')) }}

        {{ Form::submit('New Setlist!', array('class' => 'btn btn-primary')) }}

        @component('setlists.form', ['setlist'=>$setlist->setlist, 'title'=>$setlist->title, 'konzert'=>$konzert])
        @endcomponent
        {{ Form::close() }}
    </main>
@endsection
