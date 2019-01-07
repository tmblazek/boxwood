@extends('layouts/app')
@section('PageTitle', 'Konzerte')
@section('description')
	Paddy’s Return - Liste unserer Konzerte.
@endsection
@section('content')
    <main class="main-content">
        <div class="fullwidth-block" >
            <div class="container" >
	<div itemscope itemtype="http://schema.org/MusicGroup">
		<meta itemprop="name" content="Paddy's Return">
		<meta itemprop="sameAs" content="http://www.paddysreturn.com/band">
		<div class="page-title">
			<h1 class="text-center">Alle Konzerte</h1>
		</div>
		<div class="text-center">Mit dem Filter kann die Liste der angezeigten Konzerte eingeschränkt werden. <br>Für Details Konzert anklicken 
		</div>
		<div class="">
			<div class="btn-group" role="group">
			<!--link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neues Konzert'.html_safe, new_konzert_path, :class=> "btn btn-primary"%>
					<% end %>
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
						 @button_label%>	<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
						<li role="presentation">< link_to 'Ausblenden', konzerte_path(:no_hidden=>"true"), role: "menuitem", tabindex: "-1" %></li>
						<li role="presentation"> link_to 'Alle zeigen', konzerte_path(:show_past=>"true"), role: "menuitem", tabindex: "-1" %></li>
						<li role="presentation">< link_to 'Zukünftige zeigen', konzerte_path,  role: "menuitem", tabindex: "-1" %></li>
					</ul>
				<% end %>
-->
			</div>
			<div class="btn-group" role="group">
				<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					{{(null === app('request')->input('jahr')) ?  "Nach Jahr filtern" : app('request')->input('jahr')}}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/konzerte')}}">Alle Konzerte anzeigen</a></li>
					<li role="presentation" class="divider"></li>
					@foreach($jahre as $j)
						<li role="presentation"><a href="{{url('/konzerte?jahr='.$j)}}">{{$j}}</a></li>
					@endforeach
				</ul>

<div class="btn-group" role="group">
<a href="/internal/konzerte/create"><div class="btn btn-primary"> Neues Konzert Anlegen</div></a>
</div>

			</div>
		</div>
  </div>
            </div>
    <div class="fullwidth gallery" data-bg-color="#191919">
        <div class="container">
		<!--if params[:no_hidden] != 'true' and can? :inspect, Konzert %>
			<h2>  @unpub_header%> </h2>
			 render partial: "konzert_list", locals: {konzert: @unpublished} unless @unpublished.empty?%>
			<h2> Veröffentlichte Konzerte </h2>
		<% end %>-->
			@can('read')
				<div class="col-sm-6">
@else
	<div class="col-xs-12">
				@endcan
    <h3>Zukünftige Konzerte</h3>
			@component('konzerte.list', ['konzerte'=>$konzerte->filter(function($kon){return $kon->start_t>=date('Y-m-d');}), 'future'=>true])
				@endcomponent
    <h3>Vergangene Konzerte</h3>
			@component('konzerte.list', ['konzerte'=>$konzerte->filter(function($kon){return $kon->start_t<date('Y-m-d');}), 'future'=>false])
			@endcomponent
        </div>
						@can('read')
							<div class="col-sm-6">
								<h3>Private Konzerte Zukunft</h3>
								@component('konzerte.list', ['konzerte'=>$private->filter(function($kon){return $kon->start_t>=date('Y-m-d');}), 'future'=>false])
								@endcomponent
								<h3>Private Vergangene Konzerte</h3>
								@component('konzerte.list', ['konzerte'=>$private->filter(function($kon){return $kon->start_t<date('Y-m-d');}), 'future'=>false])
								@endcomponent
							</div>
	@endcan
  </div>
   </main>
   @endsection
