@extends('layouts/internal')
@section('PageTitle', $setlist->konzert->title)
@section('content')

    <main class="main">

        <div class="fullwidth-block">
            <div class=" container">
                <div class="page-header">
                    <h1 class="title-page text-center konzert_listing">{{$setlist->full_title()}}<br>
                        <small class="mysmall">{{$setlist->konzert->start_t}} </small>
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
                    <div class="btn-group" role="group">
                        <a href="/internal/setlists/create?copy={{$setlist->id}}"><button class="btn btn-primary">Copy</button>

                        {{Html::linkAction('SetlistController@edit', 'Bearbeiten', $setlist->id,array('class' => 'btn btn-primary'))}}
                        {{ Form::open(array('url' => 'internal/setlists/' . $setlist->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Löschen  ', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                        <!--<% link_to "Druckansicht", abc_tune_path(@tune), class: "btn btn-primary"%>
                        <% if can? :manage, Tune %>
                            <% link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuer Tune'.html_safe, new_tune_path, :class=> "btn btn-primary"%>
                              <% link_to '<b>Bearbeiten</b>'.html_safe, edit_tune_path(@tune),
                                class: "btn btn-primary"  %>
                                <% link_to '<b style="font-color:red">Löschen</b>'.html_safe, tune_path(@tune),method: :delete,data: { confirm: 'Are you sure?' }, class: "btn btn-primary"  %>
                                  <% end %>-->

                    </div>
                    @component('tunes.template_quer')
                @endcomponent

                    @foreach($setlist->getTunesOrdered() as $index => $tune)
                        @component('tunes.partial_tune_quer', ['tune'=>$tune, 'index'=>$index])
                            @endcomponent
                        @endforeach


            </div>
        </div>
    </main>
@endsection