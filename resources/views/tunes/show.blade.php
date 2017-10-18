@extends('layouts/internal')
@section('PageTitle', $tune->title)
@section('content')

    <div class="page-title">
        <h1 class="text-center">{{$tune->title}}</h1>
    </div>
    <main class="main">

        <div class="fullwidth-block">
            <div class="container">

                <!-- <small class="mysmall"> @tune.tag_list.each do |tag| %>
                   | <% tag.to_s %>
                   <%end %> |</small></h1>-->
                <div class="row-fluid text-right hidden-print">
                    <div class="btn-group" role="group">
                            {{Html::linkAction('TuneController@edit', 'Bearbeiten', $tune->id,array('class' => 'btn btn-primary'))}}
                        {{ Form::open(array('url' => 'internal/tunes/' . $tune->id, 'class' => 'pull-right')) }}
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
                <h2 class="text-center">Setlist Infos </h2>
                <div class="visible-print title-page">{{$tune->title}}</div>
                @foreach($tune->get_tags() as $tag)
                    {{$tag}} -
                @endforeach
                @component('tunes.template_quer')
                @endcomponent
                @component('tunes.partial_tune_quer', ['tune'=>$tune, 'index' => 0])
                @endcomponent
                <hr>
                <h2 class="text-center">Weitere Informationen </h2>
                <p>
                    <strong>Michi:</strong><br>
                    {!! $tune->michi !!}<br></p>
                <hr>
                <strong> Verwendet in {{count($tune->setlists)}} Setlists: </strong><br>|
                @foreach($tune->setlists as $setlist)
                    <a href="/internal/setlists/{{$setlist->id}}">{{$setlist->full_title()}}</a> |
                @endforeach


                <p>
                <h2 class="text-center">Songtext</h2>
                {!! $tune->songtext !!}
                </p>
                <div id="notation" class="text-center"></div>
                        <div id="notation" class="text-center"></div>

                        <div class="col-xs-12">

                        </div>
                        <strong>Status:</strong><br>
                        {{$tune->status}}<br>


                        <div class="hidden-print">
                            <h2 class="title-page text-center"> ABC </h2>
                            <code class="text-left">
                            {!! nl2br($tune->abc) !!}
                            </code>
                        </div>
            </div>

            </div>
    </main>
{{Html::script('js/abcjs_basic_2.0-min.js')}}
    <script type="text/javascript">

        var tune = "{!! $tune->abc_for_js() !!}";
        var book = new ABCJS.TuneBook(tune);
        var fileHeader = book.header;
        var numberOfTunes = book.tunes.length;

        function execute_onclick() {
            for (var i = 0; i < numberOfTunes; i++) {
                var title = book.tunes[i].title;
                var tuneAndHeader = book.tunes[i].abc;
                var justTheTune = book.tunes[i].pure;
                var id = book.tunes[i].id;

                var div = document.createElement('div');
                div.setAttribute('id', 'not'.concat(i.toString()));
                //div.setAttribute('class', 'photo');
                var parentDiv = document.getElementById('notation');
                parentDiv.insertBefore(div, null);

                ABCJS.renderAbc('not'.concat(i.toString()), tuneAndHeader, {});
            }
        };
        window.onload = execute_onclick();
    </script>
@endsection