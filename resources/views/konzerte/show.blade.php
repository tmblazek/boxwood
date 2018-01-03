@extends('layouts.app')
@section('PageTitle', $konzert->title)
@section('description')
    Paddy’s Return - {{$konzert->title}}
@endsection
@section('content')
    <div class="page-title">
        <h1 class="text-center">{{$konzert->title}}</h1>
    </div>
    <main class="main-content">
        <div class="fullwidth-block" data-bg-color="#191919">

            <div class="container">

                <div class="row-fluid clearfix">
                    <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12">
<h2>Informationen</h2>
                        @can('read')
                            <div class="btn-group">
                                @if(null!==$konzert->setlist)
                                    <a href="/internal/setlists/{{$konzert->setlist->id}}">
                                        <div class="btn btn-primary">
                                            Zur Setlist
                                        </div>
                                    </a>
                                @else
                                    <a href="/internal/setlists/create?konzert={{$konzert->id}}">
                                        <div class="btn btn-primary">
                                            Neue Setlist
                                        </div>
                                    </a>
                                @endif
                            </div>
                        @endcan

                        <span itemprop="description">


                                    <div class="col-xs-12"></div>
                            {!! $konzert->dest !!}
				</span>
                        <h2 class="">
								<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
									Eintritt: <span itemprop="price">{{$konzert->price}}</span>
								</span>
                        </h2>
                        @unless (null==$konzert->plakat_file_name)
                            <div class="hidden-xs">

                                <h2 class="title-page"> Plakat</h2>
                                <span class="text-center" itemprop="image">

@if(false === strpos($konzert->plakat_file_name, '/photos/'))
				<img src="{{asset('/system/konzerte/plakats/000/000/'.sprintf("%03d", $konzert->id).'/original/'.$konzert->plakat_file_name)}}"
                     class="photo " style="max-width:80%;   display: block;
    margin: 0 auto;">
@else
                                        <img src="{{asset($konzert->plakat_file_name)}}"
                                             class="photo " style="max-width:80%;   display: block;
    margin: 0 auto;">
                                    @endif

						<div class="text-center" style="font-size:80%">
                            {{$konzert->photocredit}}
                        </div>
					</span>
                            </div>
                            @endunless


                            </span>

                    </div></div>
                    <div class="col-xs-12 col-sm-6">
<div class="row-fluid clearfix">         <div class="col-xs-12">                   <h2>Termin</h2></div></div>
                        <div class="col-md-7">

                        <div class="event" itemscope itemtype="http://schema.org/MusicEvent">


                            <div class="entry-date" itemprop="startDate" content="{{$konzert->start_t}}">
                                <div class="date">{{(date_create($konzert->start_t)->format('Y-m-d')==date('Y-m-d')) ? 'HEUTE' : date_create($konzert->start_t)->format('d')}}</div>
                                <div class="month">{{(date_create($konzert->start_t)->format('Y-m-d')==date('Y-m-d')) ? '' : date_create($konzert->start_t)->format('M')}}</div>
                                <div class="year">{{(date_create($konzert->start_t)->format('Y-m-d')==date('Y-m-d')) ? '' : date_create($konzert->start_t)->format('Y')}}</div>
                            </div>
                            <h3 class="entry-title"><span itemprop="name">{{$konzert->place}}</span></h3>
                            <p><i>Beginn</i>: {{date_create($konzert->start_t)->format('H:i')}} Uhr<br>
                                <i>Ende</i>: {{date_create($konzert->end_t)->format('H:i')}} Uhr {{(date_create($konzert->start_t)->format('Y-m-d')==date_create($konzert->end_t)->format('Y-m-d')) ? '' :
												'am '.date_create($konzert->end_t)->format('d.m.')}}</p>

                        </div> <!-- .event -->
                        <span itemprop="location" itemscope itemtype="http://schema.org/EventVenue">


							<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<i><span itemprop="streetAddress">{{$konzert->address}}</span>,
									<span itemprop="postalCode">{{$konzert->postal}}</span>
									<span itemprop="addressLocality">{{$konzert->city}}</span></i><br>
									<span itemprop="addressRegion">{{$konzert->region}}</span>,
									<span itemprop="addressCountry">{{$konzert->country}}</span>
							</span>
							<br>

                            @if($konzert->placeurl !='')
                                <a href="{{$konzert->placeurl}}" target="_blank">Zur Homepage des Veranstalters</a>
                            @endif

                        </span>
                        </div>
                        <div class="col-md-5">
                            <img class="photo" src="{{'/photos/shares/qr_'.$konzert->id.'.svg'}}" width="400px" style="max-width:80%">
                            <br>
                            <a href="{{'/files/shares/ical_'.$konzert->id.'.ics'}}">iCalendar-Download</a>
                        </div>
                            @unless ($konzert->dismaps)
                                <iframe
                                        width="80%"
style="   display: block;
    margin: 0 auto;"
                                        height="400"
                                        frameborder="0" style="border:0"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBP1L0FLWrrlxV4seiXeL8tOG7VyDCopFY&q={{str_replace(' ', '+', $konzert->address.'+'.$konzert->postal.'+'.$konzert->city.'+'.$konzert->region.'+'.$konzert->country)}}">
                            </iframe>
                                @endunless

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection