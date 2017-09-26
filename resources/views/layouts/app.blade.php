
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
</body>
</html>