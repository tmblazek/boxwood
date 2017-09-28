
@extends('layouts/app')
@section('content')
    <div class="row-fluid clearfix">


        <div class="page-title">
            <h1 class="text-center">Informationen</h1>

        </div>

    </div>
    <main class="main">
        <div class="hidden-print text-right">
            <div class="btn-group">
                <!--
                link_to '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Bearbeiten'.html_safe, edit_page_path(@page), class: "btn btn-primary"
                link_to '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen'.html_safe, page_path(@page),method: :delete,
                                    data: { confirm: 'Are you sure?' }, class: "btn btn-primary" -->
            </div>
        </div>

            @foreach($pages as $index=>$page)
        <div class="fullwidth-block" data-bg-color="{{$index % 2 == 0 ? '#191919' : '#343434'}}">
                <div class="container">
                    <h2 class="title-page">{{$page->title}}</h2>
@component('single_page', ['page'=>$page])
    @endcomponent
                </div>
        </div>
    @endforeach
        </div>
    </main>
@endsection