@extends('layouts/app')
@section('content')
<div class="container-fluid pageboard">
    <div class="embed-responsive embed-responsive-4by3">
        <iframe  class="embed-responsive-item" src="{{$recording->embed}}" allowfullscreen></iframe>

    </div>
</div>
@section('content')