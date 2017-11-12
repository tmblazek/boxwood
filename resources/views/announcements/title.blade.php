
@foreach($announcements as $a)
        <div class="">

	          
        </div>
        <li class="lazy-bg" data-background=" {{$a->photo_file_name }} ">
            <div class="container">
                <h2 class="slide-title">  {{$a->title}}</h2>
                <h3 class="slide-subtitle"> {{$a->message}} </h3>
                <p class="slide-desc hidden-xs hidden-sm"> {{$a->text}}</p>
               
                <a href="{{$a->link}}" class="button cut-corner">Mehr Lesen</a>
            </div>
        </li>
@endforeach
</div>
