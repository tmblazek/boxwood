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
@can('read')
                    <div class="btn-group">
                        @if(null!==$konzert->setlist)
                            <a href="/internal/setlists/{{$konzert->setlist->id}}">
                        <div class="btn btn-primary">
                           Zur Setlist
                        </div>
                            </a>
                            @else
                            <a href="/internal/setlists/new?konzert={{$konzert->id}}">
                                <div class="btn btn-primary">
                                    Neue Setlist
                                </div>
                            </a>
                            @endif
                    </div>
                    @endcan
                    <div class="col-xs-12 col-sm-7">
                        <div class="row-fluid clearfix">
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
                                <h3 class="title-page">
								<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
									Eintritt: <span itemprop="price">{{$konzert->price}}</span><br>
								</span>
							</h3>
							</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-5 boxed">
                        @unless ($konzert->dismaps)
                            <iframe
                                    width="100%"
                                    height="400"
                                    frameborder="0" style="border:0"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBP1L0FLWrrlxV4seiXeL8tOG7VyDCopFY&q={{str_replace(' ', '+', $konzert->address.'+'.$konzert->postal.'+'.$konzert->city.'+'.$konzert->region.'+'.$konzert->country)}}">
                            </iframe>
                        @endunless
                    </div>
                </div>
            </div>

            <div class="fullwidth-block" data-bg-color="#333333">
                <div class="container">
                    <h2 class="text-center">Weiterführende Information</h2>
                    @unless($konzert->dest=="" && null == $konzert->plakat_file_name)
                        <div class="col-sm-7 boxed">
				<span itemprop="description">
                    @unless($konzert->dest=="")
						<h3 class="text-center title-page">Details</h3>

						<div class="bordered boxed"></div>
                    {!! $konzert->dest !!}
                        @endunless
				</span>
                            @unless (null==$konzert->plakat_file_name)


                                <h3 class="title-page text-center"> Plakat </h3>
                                <div class="bordered boxed text-center"></div>
                                <span class="text-center" itemprop="image">
				<img src="{{asset('/system/konzerte/plakats/000/000/'.sprintf("%03d", $konzert->id).'/original/'.$konzert->plakat_file_name)}}"
                     class="photo">

						<span style="font-size:80%">{{$konzert->photocredit}} </span>
					</span>
                            @endunless
                        </div>

                        <div class="col-xs-12 col-sm-5 boxed text-center">
                            @else
                                <div class="col-xs-12 col-sm-7 boxed text-center">
                                    @endunless
                                    <h4 class="title-page text-center">QR-Code</h4>
                                    <img src="{{asset('/system/konzerte/qr_cs/000/000/'.sprintf("%03d", $konzert->id).'/original/qr_code.png')}}"
                                         class="photo">

                                </div>
                        </div>
                </div> <!-- item -->
            </div>
        </div>

    </main>
@endsection