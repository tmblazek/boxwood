@extends('layouts/internal')
@section('PageTitle', 'Announcements')
@section('content')
<div class="header-wrapper">
  <div class="page-header">
<h1 class="title-page text-center">Alle Ankündigungen</h1>
</div>
</div>

<div class="fullwidth-block">
  <div class="container">
    <div class="row-fluid text-right">
      <div class="btn-group" role="group">
        {{Html::linkAction('AnnouncementController@create', 'Neues Announcements', [], ['class'=>'btn btn-primary'])}}
      </div>
    </div>
 @foreach($announcements as $ann)
      <div class="row-fluid text-right hidden-print">
        <div class="btn-group" role="group">
        {{Html::linkAction('AnnouncementController@edit', 'Bearbeiten', $ann->id,array('class' => 'btn btn-primary'))}}
        {{ Form::open(array('url' => 'internal/announcements/' . $ann->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete this Tune  ', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
        <!--<% link_to "Druckansicht", abc_tune_path(@tune), class: "btn btn-primary"%>
                        <% if can? :manage, Tune %>
                            <% link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuer Tune'.html_safe, new_tune_path, :class=> "btn btn-primary"%>
                              <% link_to '<b>Bearbeiten</b>'.html_safe, edit_tune_path(@tune),
                                class: "btn btn-primary"  %>
                                <% link_to '<b style="font-color:red">Löschen</b>'.html_safe, tune_path(@tune),method: :delete,data: { confirm: 'Are you sure?' }, class: "btn btn-primary"  %>
                                  <% end %>-->
        </div>
      </div>
   <h3>{{$ann->id.': '.$ann->title}}</h3>
   <p>{!! $ann->message !!}</p>
   {{$ann->public ? 'PUBLIC': 'PRIVATE'}}: {{$ann->pub_start.' --> '.$ann->pub_end}}<br>
   {{$ann->photo_file_name}}<br>
   Text: {{$ann->text}}<br>
   Link: {{$ann->link}}
  @endforeach
  </div>
</div>
@endsection