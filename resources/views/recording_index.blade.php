@extends('layouts/app')
@section('PageTitle', 'Musik')
@section('description')
    Paddy’s Return - Liste unserer Aufnahmen.
@endsection
@section('content')
    <main class="main">
        <div class="page-title">
            <h2 class="text-center">Musik</h1>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                @can('read')
                <div class="row-fluid text-right">
                    <div class="btn-group" role="group">
                        {{Html::linkAction('AnnouncementController@create', 'Neues Announcements', [], ['class'=>'btn btn-primary'])}}
                    </div>
                </div>
                @endcan
                <div class="col-sm-8">
                    <h2>Videos</h2>
            @foreach($recordings as $key => $recording)
                @unless ( ($key % 2 == 0) && ($key == (count($recordings)-1)))
                    <div class="col-sm-6">
                @else
                            <div class="col-sm-6 col-sm-offset-3">
                @endunless
                                @can('read')
                                    <div class="row-fluid text-right hidden-print clearfix">
                                        <div class="btn-group" role="group">
                                        {{Html::linkAction('recordings@edit', 'Bearbeiten', $recording->id,array('class' => 'btn btn-primary'))}}
                                        {{ Form::open(array('url' => 'musik/' . $recording->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete this Song  ', array('class' => 'btn btn-warning')) }}
                                        {{ Form::close() }}
                                        <!--<% link_to "Druckansicht", abc_tune_path(@tune), class: "btn btn-primary"%>
                        <% if can? :manage, Tune %>
                            <% link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuer Tune'.html_safe, new_tune_path, :class=> "btn btn-primary"%>
                              <% link_to '<b>Bearbeiten</b>'.html_safe, edit_tune_path(@tune),
                                class: "btn btn-primary"  %>
                                <% link_to '<b style="font-color:red">Löschen</b>'.html_safe, tune_path(@tune),method: :delete,data: { confirm: 'Are you sure?' }, class: "btn btn-primary"  %>
                                  <% end %>-->
                                        </div>
                                        @endcan
                                <div class="embed-responsive embed-responsive-4by3">

                                    <iframe class="embed-responsive-item" src="{{$recording->embed}}"
                                            allowfullscreen></iframe>


                                </div>
                                <p>
                                    {!! $recording->desc !!}
                                </p>
                            </div>

                    @endforeach
                    </div>

                <div class="col-sm-4">
                    <h2>Soundcloud</h2>
                    <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/91088186&amp;color=%23406454&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true"></iframe>
                </div>
        </div>
    </main>
@endsection