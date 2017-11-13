@extends('layouts/app')
@section('PageTitle', 'Paddy’s Return')
@section('description')
    Paddy’s Return - Pure Irish Folk Music in Wien!
    @endsection
@section('content')
    <!-- TITLE -->

    <div class="hero">
        <div class="slider">
            <ul class="slides">
                @component('announcements.title', ['announcements'=>$announcements])
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
                    <div class="col-xs-12">
                        <h2> Willkommen!</h2>
                        {!! $band_bio->short_desc  !!}

                        
                    </div>
                    <div class="fullwidth-block" itemprop="track" itemscope itemtype="http://schema.org/MusicRecording">
                        <div class="col-xs-12">                    <h2> Musik</h2></div>
                        <meta itemprop="name" content="Paddy's Return - Up in the Air - Mug of Brown Ale">
                        @foreach($recordings as $recording)
                            <div class="col-sm-6">
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
                </div>
                <div class="col-md-4">

                    <!-- SOUND EXAMPLES -
                         <!-- ANNOUNCEMENTS -->

                    <div class="fullwidth-block">
                        <h2>Facebook</h2>
                        <div class="fb-page" data-href="https://www.facebook.com/paddysreturnvienna/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/paddysreturnvienna/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/paddysreturnvienna/">Paddy&#039;s Return</a></blockquote></div>
                        <h2>Kommende Konzerte </h2>

                        @component('konzerte.list', ['konzerte'=>$konzerte])
                        @endcomponent

                    </div>

                  
                    
                    <h2>Email Kontakt</h2>
                    {{Html::mailto('info@padddysreturn.com')}}
                </div>

            </div>
        </div>
    </main>

@endsection
