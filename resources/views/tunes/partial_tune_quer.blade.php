<div class="row-fluid clearfix bordered">
	<div class="col-xs-1">{{$index + 1}}</div>
	<div class="col-xs-4"><span class="hidden-print"><a href="/internal/tunes/{{$tune->id}}">{{$tune->title}}</a></span><span class="visible-print">{{$tune->title}}</span></div>
	<div class="col-xs-1">{{$tune->tonart}}</div>
	<div class="col-xs-2">{{$tune->typ}}</div>
	<div class="col-xs-4">{!! $tune->general_notes !!}</div>
</div>