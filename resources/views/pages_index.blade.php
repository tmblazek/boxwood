@extends('layouts/app')
@section('content')
    <main class="main">
        <div class="fullwidth-block">
            <div class="container">


                <div class="page-title">
                    <h1 class="text-center">Informationen</h1>

                </div>

            </div>
        </div>

        @foreach($pages as $index=>$page)
            <div class="fullwidth-block" data-bg-color="{{$index % 2 == 0 ? '#191919' : '#343434'}}">
                <div class="container">
                    <div class="row">
                        <h2 class="text-center title-page">{{$page->title}}</h2>
                        @component('single_page', ['page'=>$page])
                        @endcomponent
                    </div>
                </div>
            </div>
        @endforeach

    </main>
@endsection