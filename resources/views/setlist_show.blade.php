@extends('layouts/internal')
@section('PageTitle', $setlist->konzert->title)
@section('content')

    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
                <div class="page-header">
                    <h1 class="title-page text-center konzert_listing">Setlist<br>
                        <small class="mysmall">{{$setlist->konzert->start_t}}: {{$setlist->full_title()}}</small>
                    </h1>
                </div>
                <div class="row text-right">
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-expanded="true">
                            Drucken <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a href="{{'/internal/setlists/'.$setlist->id.'/druckvorschau'}}"
                                                       class="menuitem" , tabindex="-1">Druckvorschau</a></li>
                            <li role="presentation"><a href="{{'/internal/setlists/'.$setlist->id.'/michi'}}"
                                                       class="menuitem" , tabindex="-1">Michi</a></li>
                            <!--<li role="presentation"><% link_to 'Hochformat'.html_safe, hochformat_setlist_path(@setlist, format: :pdf), role: "menuitem", tabindex: "-1"  %>    </li>
                                <li role="presentation">< link_to 'Bodhrán Info'.html_safe, michi_setlist_path(@setlist, format: :pdf), role: "menuitem", tabindex: "-1"  %>    </li>-->
                        </ul>
                    </div>

                </div>
                <h2>
                    <a href="{{'/konzerte/'.$setlist->konzert->id}}">{{$setlist->konzert->title}}</a>
                </h2>
                <h2>
                    {{$setlist->title}}
                </h2>
                <h2>Tunes </h2>
                {{$setlist->setlist}}
                @component('tunes.template_quer')
                @endcomponent

                    @foreach($setlist->tunes as $index => $tune)
                        @component('tunes.partial_tune_quer', ['tune'=>$tune, 'index'=>$index])
                            @endcomponent
                        @endforeach


            </div>
        </div>
    </main>
@endsection