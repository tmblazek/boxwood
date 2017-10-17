
<!-- Stored in resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="Paddy's Return - @yield('PageTitle')" property="og:title" />
<meta name="description" content="@yield('description')">
    <title>@yield('PageTitle')</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Styles -->
    {{ \Html::script('js/respond.min.js') }}
    {{ \Html::script('js/application.js') }}
    {{ \Html::script('js/jquery.ui.widget.js') }}

    {{ \Html::script('js/plugins.js') }}
    {{ \Html::style('fonts/font-awesome.min.css') }}
    {{ \Html::style('css/glyphicons.css.css') }}
    {{ \Html::style('css/application.css.css') }}

</head>
<body class={{isset($body_class) ? $body_class : ''}}>
		    <div id="site-content">
            <header class="site-header">
                <div class="container">
					          <a href="{{url('/')}}" id="branding">
						            <img src="{{asset('/brand2.png')}}" alt="Site Title">
					          </a> <!-- #branding -->


					          <nav class="main-navigation">
						            <button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
						            <ul class="menu">
                            <!-- <li class="menu-item" ></li>-->
                            <li class="menu-item {{ strpos(request()->path(),'stpatricksnight')!==false ? 'current-menu-item' : ''}}"><a href="{{url('/stpatricksnight')}}">St. Patrick’s Night</a></li>
                            <li  class="menu-item {{strpos(request()->path(),'konzerte')!==false ? 'current-menu-item' : ''}}"><a href="{{url('/konzerte')}}">Konzerte</a></li>
                            <li  class="menu-item {{strpos(request()->path(),'band')!==false ?  'current-menu-item' : ''}}"><a href="{{url('/band')}}">Die Band</a></li>
                            <li  class="menu-item {{strpos(request()->path(),'musik')!==false  ? 'current-menu-item' : ''}}"><a href="{{url('/musik')}}">Musik</a></li>
                            <li  class="menu-item {{strpos(request()->path(),'informationen')!==false ?  'current-menu-item' : ''}}"><a href="{{url('/informationen')}}">Informationen</a></li>
                                        @can('read')
                                        <li class="menu-item"><a href="{{url('/internal/tunes')}}">Tunebook</a></li>
                                            <li class="menu-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                                        @endcan
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
                            Obkirchergasse 38/4/8,                             1190, Wien <br>
                            Österreich<br>
                            {{Html::mailto('webmaster@gmail.com')}}

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
                (function() {
                    var u="//analytics.paddysreturn.com/piwik/";
                    _paq.push(['setTrackerUrl', u+'piwik.php']);
                    _paq.push(['setSiteId', '1']);
                    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
                })();
            </script>
            <!-- End Piwik Code -->

</body>
</html>