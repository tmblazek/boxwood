
<!-- if there are creation errors, they will show here -->

<div class="form-group">
    {{ Form::label('title', 'Name') }}
    {{ Form::text('title', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('embed', 'Embed') }}
    {{ Form::text('embed', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
{{ Form::label('desc', 'Description') }}
    {{ Form::textarea('desc', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
{{ Form::label('desc', 'Order') }}
    {{ Form::number('order', null, array('class' => 'form-control')) }}
</div>
