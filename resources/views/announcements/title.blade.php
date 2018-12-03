
@foreach($announcements as $a)
        <div class="">

	          
        </div>
        <li class="lazy-bg" data-background=" {{$a->photo_file_name }} ">
            <div class="container">
                <h2 class="slide-title" style="text-shadow:2px 2px 2px #000000">  {{$a->title}}</h2>
                <h3 class="slide-subtitle" style="text-shadow:2px 2px 2px #000000"> {{$a->message}} </h3>
                <p class="slide-desc hidden-xs hidden-sm " style="text-shadow:2px 2px 2px #000000""> {{$a->text}}</p>
               
                <a href="{{$a->link}}" class="button cut-corner">Mehr Lesen</a>
            </div>
        </li>
@endforeach
</div>
