<!-- if there are creation errors, they will show here -->

<div class="form-group">
    {{ Form::label('title', 'Name') }}
    {{ Form::text('title', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('dest', 'dest') }}
    {{ Form::textarea('dest', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('place', 'place') }}
    {{ Form::text('place', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('address', 'address') }}
    {{ Form::text('address', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('placeurl', 'placeurl') }}
    {{ Form::text('placeurl', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('city', 'city') }}
    {{ Form::text('city', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('postal', 'postal') }}
    {{ Form::number('postal', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('region', 'region') }}
    {{ Form::text('region', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('country', 'country') }}
    {{ Form::text('country', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('photocredit', 'photocredit') }}
    {{ Form::text('photocredit', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('price', 'price') }}
    {{ Form::textarea('price', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('band', 'band') }}
    {{ Form::textarea('band', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('dismaps', 'dismaps?') }}
    {{ Form::checkbox('dismaps',true, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('pinned', 'pinned?') }}
    {{ Form::checkbox('pinned',true, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('hidden', 'hidden?') }}
    {{ Form::checkbox('hidden',true, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('public', 'public?') }}
    {{ Form::checkbox('public',true, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('start_t', 'start_t') }}
    <div class='input-group date' id='datepicker1'>

        {{ Form::text('start_t', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar">
            </span>
        </span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('end_t', 'end_t') }}
    <div class='input-group date' id='datepicker2'>

        {{ Form::text('end_t', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
    </div>
</div>


<div class="form-group">
    {{ Form::label('photo_file_name', 'Name') }}
    <div class="input-group">

            <span class="input-group-btn">
       <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
      <i class="fa fa-picture-o"></i> Choose
    </a>
  </span>
        {{ Form::text('plakat_file_name', null, array('class' => 'form-control','id'=>'thumbnail')) }}

    </div>
    <img id="holder" style="margin-top:15px;max-height:100px;">
</div>


<script>
    $(function () {
        $('#lfm').filemanager('images');
    });
</script>
