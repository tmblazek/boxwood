@extends('layouts/internal')
@section('PageTitle', 'Tunebook')
@section('content')
<div class="page-title">
<h1 class="text-center">Tunebook</h1>
</div>
<main class="main">

    <div class="fullwidth-block">
        <div class=" container">
            <div class="row-fluid text-right">
                <div class="btn-group" role="group">

                </div>
            </div>
             <!--    if can?(:manage, :all) && params[:tag_filter].nil? %>
                    Tags filter: 
                     ActsAsTaggableOn::Tag.all.each do |tag| %>
                        |  link_to tag.to_s, :tag_filter => tag.to_s %>
                    end %> |<br>
                <% else %>
                    <= link_to "Alle Tunes", tunes_path %>
                <% end %>-->
@foreach($tunes as $tune)
<div class="">
    <a href="{{url('/tunes/'.$tune->id)}}">{{$tune->title}}</a> |
<%= link_to t.title, tune_path(t) %> | <%= !t.setlists.empty? ? t.setlists.length : 0%> Setl.
</div>
<% end %>
<%= link_to 'New Tune', new_tune_path %>
        </div>
    </div>
@endforeach
</main>

@endsection