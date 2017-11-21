
    @extends('layouts.pdf')
    @section('date', $setlist->konzert->start_t)
    @section('content')

        <table style="width:100%">
            <thead>
            <tr style="font-weight:normal;">

                <th colspan="4" class="text-center" style="font-family: Glanchlo;font-size:14pt;font-weight:normal;"><div class="text-left" style="float: left; width: 40%">Paddy's Return</div><div class="text-right" style="float: right; width: 60%"> {{$setlist->konzert->title}} - </div></th>
                <th colspan="2" class="text-center" style="font-family: Glanchlo;font-size:14pt;font-weight:normal;"><div class="text-left" style="float: left; width: 70%">&nbsp;{{$setlist->konzert->start_t}}</div><div class="text-right" style="float: right; width: 30%"><span class="page">Seite </span></div></th>
            </tr>
            <tr>
                <th valign="top" width="10%" style="text-align:left;">Bodhrán</th>
                <th valign="top" width="5%" style="text-align:center;">Nr</th>
                <th valign="top" width="30%">Title</th>
                <th valign="top" width="10%">Tonart</th>
                <th valign="top" width="10%">Typ</th>
                <th valign="top" width="35%"> Notizen</th>
            </tr>
            </thead>
         @foreach($setlist->getTunesOrdered() as $index=>$tune)

            <div class="nobreak">
                <tr style="page-break-inside: avoid;">
                    <td valign="top" width="10%" style="page-break-inside: avoid;">{!! $tune->michi !!}</td>
<td valign="top" width="5%" style="text-align:center;page-break-inside: avoid;"><b>{{$index+1}}</b></td>
<td valign="top" width="30%" style="page-break-inside: avoid;">{{$tune->title}}</td>
<td valign="top" width="10%" style="page-break-inside: avoid;">{{$tune->tonart}}</td>
<td valign="top" width="10%" style="page-break-inside: avoid;">{{$tune->typ}}</td>
<td valign="top" width="35%" style="page-break-inside: avoid;"> {!! $tune->general_notes !!}</td>
</tr>
</div>
            @endforeach
        </table>
<style>
td {
	font-size:110%;
	padding-top:8px;
	padding-bottom:8px;
	padding-left:2px;
	padding-right:2px;
	border-top: 1px solid black;

}
tr {

}
div.nobreak:before { clear:both; }
div.nobreak{ page-break-inside: avoid;  }
</style>

@endsection
