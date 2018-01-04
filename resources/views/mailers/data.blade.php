<html>
<body>
<h1>
    Änderung in {{$title}}
</h1>
Die neueste Version ist unter <a href="{{$url}}">{{$url}}</a> zu finden.
<h2>
    Änderungen an der Setlist
</h2>
@if(sizeof($additions)==0 && sizeof($removals) == 0 && sizeof($order_changes)==0)
    <h3>Keine Änderungen an der Setlist selbst. Nur Metadaten wurden geändert</h3>
    @else
<h3>
    Hinzugefügt
</h3>
    <ul>
        @foreach($additions as $add)
            <li>{{$add}}</li>
            @endforeach

    </ul>
    <h3>
        Entfernt
    </h3>
<ul>
@foreach($removals as $rem)
    <li>{{$rem}}</li>
@endforeach</ul>
<h3>
    Hat Platz geändert
</h3>
<ul>
    @foreach($order_changes as $rem)
        <li>{{$rem}}</li>
    @endforeach</ul>
@endif
</body>
</html>