@extends('layouts/app')
@section('PageTitle', 'Paddy\'s Return')

@section('content')
    <!-- TITLE -->

    <div class="hero">
        <div class="slider">
            <ul class="slides">
                @component('announcements_title', ['announcements'=>$announcements])
                @endcomponent

            </ul>
        </div>
    </div>
    <main class="main-content">
        <div class="fullwidth-block gallery">
            <div class="container">
                <!-- BODY -->
                <!-- BAND -->
                <div class="col-md-8">
                    <h2> Willkommen!</h2>
                    {{$band_bio->short_desc}}

                    <div class="fullwidth-block">

                        <h2>Kommende Konzerte </h2>

                        @component('konzerte_list', ['konzerte'=>$konzerte])
                        @endcomponent

                    </div>
                </div>
                <div class="col-md-4">

                    <!-- SOUND EXAMPLES -
              <!-- ANNOUNCEMENTS -->


                    <h2> Musik</h2>
                    <div class="fullwidth-block" itemprop="track" itemscope itemtype="http://schema.org/MusicRecording">
                        <meta itemprop="name" content="Paddy's Return - Up in the Air - Mug of Brown Ale">
                        @foreach($recordings as $recording)
                            <div class="embed-responsive embed-responsive-4by3">
                                <iframe class="embed-responsive-item" src="{{$recording->embed}}"
                                        allowfullscreen></iframe>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection