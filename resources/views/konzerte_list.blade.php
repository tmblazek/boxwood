
@if(count($konzerte)==0)
<div class="boxed-thin"></div>
<div class="row-fluid clearfix">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="title-page text-center">Wir arbeiten derzeit an neuen Terminen!</h3>
		</div>
		<div class="panel-body">
			Wenn Sie per Email informiert werden wollen, wenden Sie sich bitte diese email: <%=mail_to "info@paddysreturn.com", nil,encode: "javascript"%>
		</div>
	</div>
</div>
@else
@foreach ($konzerte as $kon)
@component('konzert_item', ['konzert'=>$kon])
@endcomponent
@endforeach

@endif