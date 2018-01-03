
@if(count($konzerte)==0)
	@if ($future==true)
<div class="boxed-thin"></div>
<div class="row-fluid clearfix">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="title-page text-center">Wir arbeiten derzeit an neuen Terminen!</h3>
		</div>
		<div class="panel-body">
			Wenn Sie per Email informiert werden wollen, wenden Sie sich bitte diese email: {{Html::mailto('info@paddysreturn.com')}}
		</div>
	</div>
</div>
		@else
		<div class="row-fluid clearfix">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="title-page text-center">Keine Konzerte im gewählten Zeitraum</h3>
				</div>
			</div>
		</div>
		@endif
@else
@foreach ($konzerte as $kon)
@component('konzerte.list_item', ['konzert'=>$kon])
@endcomponent
@endforeach

@endif