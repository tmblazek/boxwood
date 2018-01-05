
<div class="fullwidth-block">
    <div class=" container">
        <!-- if there are creation errors, they will show here -->

        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('title', 'Name') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                @foreach(App\Models\Tag::all() as $tag)
                    {{$tag->name}}
                @endforeach<br>
                {{ Form::label('taggings', 'taggings') }}
                {{ Form::text('taggings', $taggings, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('abc', 'ABC') }}
                {{ Form::textarea('abc', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('general_notes', 'General Notes') }}
                {{ Form::text('general_notes', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('status', 'status') }}
                {{ Form::text('status', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('tonart', 'Tonart') }}
                {{ Form::text('tonart', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('typ', 'Typ') }}
                {{ Form::text('typ', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('michi', 'Michi') }}
                {{ Form::textarea('michi', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('songtext', 'Songtext')}}
                {{Form::textarea('songtext', null, array('class'=>'form-control', 'id'=>'my-editor')) }}
            </div>


        </div>

        <div class="col-sm-6">
            <div class="col-xs-12">
                <a href="#" onclick="execute_onclick()">Noten anzeigen</a>
            </div>
            <div id="paper0" style="max-width: 100%"></div>
        </div>


    </div>
</div>

{{ \Html::script('js/abcjs_editor_2.0-min.js') }}
<script type="text/javascript">
    function execute_onclick() {
        abc_editor = new ABCJS.Editor("abc", { paper_id: "paper0", warnings_id:"warnings", render_options:{staffwidth:"500"} });
    }
</script>

<script type="text/javascript">
    window.onload=setTimeout(execute_onclick(), 1000);
    CKEDITOR.editorConfig = function (config) {
        // ... other configuration ...

        config.toolbar_mini = [
            ["Bold",  "Italic",  "Underline",  "Strike",  "-",  "Subscript",  "Superscript"],
        ];
        config.toolbar = "simple";

        // ... rest of the original config.js  ...
    }
</script>
<script>
    CKEDITOR.replace('my-editor', options);
</script>