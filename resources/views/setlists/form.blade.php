
<div class="col-sm-8">
    <h2>Aktuelle Setlist</h2>
    <div id="current_setlist" style="overflow-y:scroll; height:700px;">
    </div>
</div>
<div class="col-sm-4">
    <div class="form-group">
        {{ Form::label('konzert', 'Konzert') }}
        {{ Form::select('konzert', $konzert_list, $konzert, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('setlist', 'setlist') }}
        {{ Form::text('setlist', $setlist, array('class' => 'form-control', 'id'=>'formsetlist')) }}
    </div>
    <div class="form-group">
        {{ Form::label('title', 'Titel') }}
        {{ Form::text('title', $title, array('class' => 'form-control', 'id'=>'formsetlist')) }}
    </div>

    <strong>Tuneablage: </strong>
    <div id="active_tune" class="panel panel-default highlight">
    </div>

    <input type="text" onkeypress="setlist_filter()" id="filter"></input>
    <div id="tune_list"></div>

</div>

<script type="text/javascript">

    window.tunes = {!!  App\Models\Tune::all_for_setlists() !!};
    window.paste_ready = false;
    window.tunes_in_setlist = [];
    window.active_tune = "";
    window.id_list = [];
    window.execl = false;
    window.last_added = -1;
    execload();
</script>

