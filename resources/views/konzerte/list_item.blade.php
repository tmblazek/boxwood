
		<div class="event"  itemscope itemtype="http://schema.org/MusicEvent">
        <meta itemprop="performer" content="Paddy's Return">
        <meta itemprop="sameAs" content="">

				<div class="entry-date"   itemprop="startDate" content="{{$konzert->start_t}}">

@if(date('Ymd') == date('Ymd', strtotime($konzert->start_t)))
                        <div class="date">HEUTE</div>
            @else
    <?php $start_date = new DateTime($konzert->start_t) ?>
            <div class="date">{{$start_date->format('d')}}</div>
            <div class="month">{{$start_date->format('M')}}</div>
            <div class="year">{{$start_date->format('Y')}}</div>
            @endif
				</div>
				<h2 class="entry-title"> <a href="{{url('/konzerte/'.$konzert->id)}}">{{$konzert->title}}</a></h2>
        <p><b itemprop="name"> {{$konzert->place}}</b>
        <br>
        <i itemprop="address">{{$konzert->address}}, {{$konzert->postal.' '.$konzert->city}}</i></p>
		</div> <!-- .event -->


