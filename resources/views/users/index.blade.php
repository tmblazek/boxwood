@extends('layouts.internal')
@section('PageTitle', 'Users')
@section('content')
    <div class="page-title">
        <h1 class="text-center">Users</h1>
    </div>
    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
                <div class="row-fluid text-right">
                </div>

                <div class="container">
                    @foreach($users as $user)
                        <h3>
                            {{$user->name}}
                            <small>{{$user->email}}
                            </small>
                        </h3>
                    <b>Roles: </b>
                        @foreach($user->roles as $r)
                            {{$r->name}}
                            @endforeach<br>
                        <b>Permissions: </b>
                        @foreach($user->permissions as $r)
                            {{$r->name}}
                        @endforeach

                    @endforeach
                </div>
            </div>
    </main>

@endsection