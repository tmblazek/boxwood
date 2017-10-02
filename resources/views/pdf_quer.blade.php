<div class="nobreak">
<tr style="page-break-inside: avoid;">
<td valign="top" width="5%" style="text-align:center;page-break-inside: avoid;">{{$index+1}}</td>
<td valign="top" width="35%" style="page-break-inside: avoid;">{{$tune->title}}</td>
<td valign="top" width="10%" style="page-break-inside: avoid;">{{$tune->tonart}}</td>
<td valign="top" width="10%" style="page-break-inside: avoid;">{{$tune->typ}}</td>
<td valign="top" width="40%" style="page-break-inside: avoid;">{!! $tune->general_notes !!} </td>
</tr>
</div>
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