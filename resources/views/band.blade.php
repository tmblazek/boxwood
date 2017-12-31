@extends('layouts/app')
@section('PageTitle', 'Die Band')
@section('description')
    Paddy’s Return - Die Band.
@endsection
@section('content')
    <main class="main" itemscope itemtype="http://schema.org/MusicGroup">
        <div class="page-title">
            <h1 class=" text-center" itemprop="name">{{$band_bio->name}}</h1>
        </div>


        <div class="fullwidth-block" data-bg-color="#191919">

            <div class="container">


                <meta itemprop="genre" content="Irish Folk">


                <div class="col-xs-12 text-left col-sm-6" itemprop="description">
                    <h2 class="text-center">Die Band</h2>
                    {!! $band_bio->long_desc !!}
                </div>
                <div class="col-xs-12 col-sm-5">
                    <img src="PADDYSRETURNimHDBklein.jpg"
                         class="photo" style="margin:0 auto;    display: block;">



                    <div style="font-size:80%" class="text-center">Photo: Verena Dreitler</div>
                </div>

            </div>

        </div>
        <div class="fullwidth-block" data-bg-color="#343434">
            <div class="container">
                <h2 class="text-center">Die Mitglieder</h2>
                <div class="row">
                    @foreach($member_bios as $index => $member)
                        @if($index %3 == 0)
                            <div class="row">
                                @endif


                                <div class="col-xs-12 col-sm-4 {{(($index == (count($member_bios) - 2))    && ($index % 3 == 0)) ? 'col-sm-offset-2': ''}} text-center"
                                     itemprop="member"
                                     itemscope itemtype="http://schema.org/Person">

                                    <h3 class="title-page text-center"
                                        itemprop="name">{{$member->name}}</h3>



                                <div class="col-sm-12 title-padding"> <!-- Photo -->
                                    <img src="{{asset('/system/biographies/photos/000/000/'.sprintf("%03d", $member->id).'/medium/'.$member->photo_file_name) }}"
                                         class="photo">
                                    <div style="font-size:80%" class="text-center">
                                        Photo: {{$member->photocredit}}</div>
                                </div> <!-- Close Photo-->


                                <div itemprop="description">
                                    <div class="col-sm-12">
                                        {!! $member->long_desc !!}
                                    </div>

                                    <div class="col-xs-12">
                                        <b>Instrumente: </b>{{$member->instruments}}
                                    </div>

                                </div><!-- description-->
                                </div> <!-- /name -->

                @if($index %3 == 2)
            </div>
            @endif

            @endforeach
        </div>
        </div>
    </main>
@endsection