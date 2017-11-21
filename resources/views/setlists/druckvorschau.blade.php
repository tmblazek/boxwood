
@extends('layouts.pdf')
    @section('date', $setlist->konzert->start_t)
    @section('content')
        <table style="width:100%">
@component('setlists.template_pdf_quer', ['setlist'=>$setlist])
    @endcomponent
    @foreach($setlist->getTunesOrdered() as $index=>$tune)
@component('pdf_quer', ['tune'=>$tune, 'index'=>$index])
        @endcomponent
        @endforeach
</table>
@endsection
