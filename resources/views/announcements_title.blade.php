
@foreach($announcements as $a)
        <div class="">

	          
        </div>
        <li class="lazy-bg" data-background=" {{asset('/data/system/announcements/photos/000/000/'.sprintf("%03d", $a->id).'/original/'.$a->photo_file_name) }} ">
            <div class="container">
                <h2 class="slide-title">  {{$a->title}}</h2>
                <h3 class="slide-subtitle"> {{$a->message}} </h3>
                <p class="slide-desc hidden-xs"> {{$a->text}}</p>
                <p>"{{ URL::to('/') }}{{'/data/system/announcements/photos/000/000/'.$a->id.'/original/'.$a->photo_file_name}}</p>
                <a href="{{$a->link}}" class="button cut-corner">Mehr lesen</a>
            </div>
        </li>
@endforeach
</div>
