<!-- Stored in resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Paddy's Return - @yield('PageTitle')" property="og:title"/>
    <meta name="description" content="@yield('description')">
    <title>@yield('PageTitle')</title>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Styles -->
    {{ \Html::script('js/respond.min.js') }}
    {{ \Html::script('js/application.js') }}
    {{ \Html::script('js/app-min.js') }}
    {{ \Html::script('js/jquery.ui.widget.js') }}

    {{ \Html::script('js/plugins.js') }}
    {{ \Html::style('fonts/font-awesome.min.css') }}
    {{ \Html::style('css/glyphicons.css.css') }}
    {{ \Html::style('css/application.css.css') }}
    {{ \Html::style('css/internal.css') }}
</head>
<body class={{isset($body_class) ? $body_class : ''}}>
<div id="site-content">
    <header class="site-header">
        <div class="container">

            <nav class="main-navigation">
                <button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
                <ul class="menu">
                    <!-- <li class="menu-item" ></li>-->
                    <li class="menu-item"><a href="/">Homepage</a></li>
                    @hasrole('admin')
                    <li class="menu-item {{strpos(request()->path(),'users')!==false ? 'current-menu-item' : ''}}"><a
                                href="{{url('/internal/users')}}">User</a></li>
                    @endhasrole
                    <li class="menu-item {{strpos(request()->path(),'konzerte')!==false ? 'current-menu-item' : ''}}"><a
                                href="{{url('/konzerte')}}">Konzerte</a></li>
                    <li class="menu-item {{strpos(request()->path(),'tunes')!==false ?  'current-menu-item' : ''}}">
                        <a href="{{url('/internal/tunes')}}">Tunebook</a></li>
                    <li class="menu-item {{strpos(request()->path(),'setlists')!==false ?  'current-menu-item' : ''}}">
                        <a href="{{url('/internal/setlists')}}">Setlists</a></li>

                    <li class="menu-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </ul> <!-- .menu -->
            </nav> <!-- .main-navigation -->
            <div class="mobile-menu"></div>
        </div>

    </header> <!-- .site-header -->

    @yield('content')

    <footer class="site-footer">
        <div class="container">

            <div class="col-sm-12">
                <img src="{{asset('brand2.png')}}" alt="Site Name">
                <address>
                    Obkirchergasse 38/4/8, 1190, Wien <br>
                    Österreich<br>
                    {{Html::mailto('webmaster@paddysreturn.com')}}

                </address>
                <div class="social-links">
                    <a href="https://www.facebook.com/paddysreturnvienna"><i class="fa fa-facebook-square"></i></a>
                </div> <!-- .social-links -->
            </div>


            <div class="col-sm-12">

                <p class="copy">Copyright 2017 Paddy's Return. Designed by Themezy. All right reserved</p>
                <a href="{{url('/login')}}">Login</a>
            </div>
        </div>
    </footer> <!-- .site-footer -->

</div> <!-- #site-content -->


<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function () {
        var u = "//analytics.paddysreturn.com/piwik/";
        _paq.push(['setTrackerUrl', u + 'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'piwik.js';
        s.parentNode.insertBefore(g, s);
    })();
</script>
<!-- End Piwik Code -->

</body>
</html>