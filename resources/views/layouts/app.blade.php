
<!-- Stored in resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Styles -->
    {{  \Html::script('js/jquery-1.11.1.min.js')}}
    {{ \Html::script('js/respond.min.js') }}
    {{ \Html::script('js/application.js') }}
    {{ \Html::script('js/app-min.js') }}
    {{ \Html::script('js/jquery.ui.widget.js') }}
    {{ \Html::script('js/plugins.js') }}

    {{ \Html::style('css/application.css.css') }}
</head>
<body class={{$body_class}}>
		    <div id="site-content">
            <header class="site-header">
                <div class="container">
					          <a href="<%=root_path%>" id="branding">
						            <img src="/assets/brand2.png" alt="Site Title">
					          </a> <!-- #branding -->


					          <nav class="main-navigation">
						            <button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
						            <ul class="menu">
                            <!-- <li class="menu-item<%= ' current-menu-item' if (request.path == root_path)%>" ><%=link_to "Startseite", root_path%></li>-->
                            <li class="menu-item<%= ' current-menu-item' if (request.path == root_path)%>" ><a href="/stpatricksnight">St. Patrick's Night </a></li>
                            <li  class="menu-item<%= ' current-menu-item' if (request.path == konzerte_path) || (!params[:id].nil? && request.path == konzert_path)%>"><%=link_to "Konzerte",  konzerte_path%></li>
                            <li  class="menu-item<%= ' current-menu-item' if (request.path == band_path)%>"><%=link_to "Die Band",  band_path%></li>
                            <li  class="menu-item<%= ' current-menu-item' if (request.path == recordings_path)%>"><%=link_to "Musik",  recordings_path%></li>
                            <li  class="menu-item<%= ' current-menu-item' if (request.path == pages_path)%>"><%=link_to "Informationen",  informationen_path%></li>
						            </ul> <!-- .menu -->
					          </nav> <!-- .main-navigation -->
					          <div class="mobile-menu"></div>
                </div>

			      </header> <!-- .site-header -->


    @yield('content')

			      <footer class="site-footer">
				        <div class="container">

                    <div class="col-sm-12">
                        <img src="/assets/brand2.png" alt="Site Name">
					              <address>
                            Obkirchergasse 38/4/8,                             1190, Wien <br>
                            Österreich<br>
                            <%=mail_cleanup("webmaster@paddysreturn.com").html_safe%>

						            </address>
                        <div class="social-links">
						                <a href="https://www.facebook.com/paddysreturnvienna"><i class="fa fa-facebook-square"></i></a>
					              </div> <!-- .social-links -->
					          </div>



	                  <div class="col-sm-12">

			                  <p class="copy">Copyright 2017 Paddy's Return. Designed by Themezy. All right reserved</p>
                        <%= link_to "Log in", login_path %>
	                  </div>
                </div>
			      </footer> <!-- .site-footer -->

		    </div> <!-- #site-content -->


        <!-- Piwik -->
        <script type="text/javascript">
         var _paq = _paq || [];
         // tracker methods like "setCustomDimension" should be called before "trackPageView"
         _paq.push(['trackPageView']);
         _paq.push(['enableLinkTracking']);
         (function() {
             var u="//piwik-inachos.rhcloud.com/analytics/piwik/";
             _paq.push(['setTrackerUrl', u+'piwik.php']);
             _paq.push(['setSiteId', '1']);
             var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
             g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
         })();
        </script>
        <!-- End Piwik Code -->


</body>
</html>