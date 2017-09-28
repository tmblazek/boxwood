
            @if (($page->photo_file_name != ""))
                <div class="photo-limit">
                    <img src="{{asset('/system/pages/photos/000/000/'.sprintf("%03d", $page->id).'/original/'.$page->photo_file_name) }}" class="photo">
                </div>
                <span style="font-size:80%">Photo: {{$page->photocredit}}</span>
            @endif

            <div class="col-xs-12 col-sm-12">
                {!! $page->content; !!}
            </div>
            <div class="col-xs-12">
            @unless($page->datei_file_name=="")
            @endunless
            <!-- link_to @page.datei_file_name, @page.datei.url unless @page.datei_file_name.nil? -->
