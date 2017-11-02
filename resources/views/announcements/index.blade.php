@extends('layouts/internal')
@section('PageTitle', 'Announcements')
@section('content')
<div class="header-wrapper">
  <div class="page-header">
<h1 class="title-page text-center">Alle Ankündigungen</h1>
</div>
</div>
<div class="row-fluid clearfix text-right">
here gioes the links
</div>
<h2 class="title-page text center"> Startseite </h2>
 @foreach($announcements as $ann)
   <h3>{{$ann->id.': '.$ann->title}}</h3>
   <p>{!! $ann->message !!}</p>
   {{$ann->public}}: {{$ann->pub_start.' --> '.$ann->pub_end}}<br>
   {{$ann->photo_file_name}}<br>
   Text: {{$ann->text}}<br>
   Link: {{$ann->link}}
  @endforeach
@endsection