
@extends('layouts.pdftunebook')
    @section('content')
        <table style="width:100%">
@component('tunes.template_pdf_quer')
    @endcomponent
    @foreach($tunes as $index=>$tune)
@component('pdf_quer', ['tune'=>$tune, 'index'=>$index])
        @endcomponent
        @endforeach
</table>
@endsection
