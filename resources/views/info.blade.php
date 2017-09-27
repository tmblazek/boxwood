@extends('layouts/app')

@section('content')
<div class="row-fluid clearfix">


	<div class="page-title">
		<h1 class="text-center">{{$page->title}}</h1>

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

  <div class="fullwidth-block">
      <div class="container">

		  @if (($page->photo_file_name != ""))
			  <div class="photo-limit">
        <img src="{{asset('/system/pages/photos/000/000/'.sprintf("%03d", $a->id).'/original/'.$page->photo_file_name) }}">
			  </div>
			  <span style="font-size:80%">Photo: {{$page->photocredit}}</span>
			  @endif

      <div class="col-xs-12 col-sm-12">
		  {!! $page->content; !!}
      </div>
      <div class="col-xs-12">
		  @unless($page->datei_file_name=="")
          @endunless
        <!-- link_to @page.datei_file_name, @page.datei.url unless @page.datei_file_name.nil? -->
      </div>
    </div>
  </div>
</main>
@endsection