<!-- if there are creation errors, they will show here -->

<div class="form-group">
    {{ Form::label('title', 'Name') }}
    {{ Form::text('title', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('message', 'Message') }}
    {{ Form::textarea('message', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('public', 'Aktiv?') }}
    {{ Form::checkbox('public', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('pub_start', 'Pub Start') }}
    <div class='input-group date' id='datepicker1'>

        {{ Form::text('pub_start', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar">
            </span>
        </span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('pub_end', 'Pub End') }}
    <div class='input-group date' id='datepicker2'>

        {{ Form::text('pub_end', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('text', 'Button Text') }}
    {{ Form::text('text', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('link', 'Link Address') }}
    {{ Form::text('link', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('photo_file_name', 'Name') }}
    <div class="input-group">

            <span class="input-group-btn">
       <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
      <i class="fa fa-picture-o"></i> Choose
    </a>
  </span>
        {{ Form::text('photo_file_name', null, array('class' => 'form-control','id'=>'thumbnail')) }}

    </div>
    <img id="holder" style="margin-top:15px;max-height:100px;">
</div>


<script>
    $(function () {
        $('#lfm').filemanager('images');
    });
</script>
