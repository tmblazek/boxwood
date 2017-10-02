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
    {{ \Html::style('css/pdf.css') }}
</head>
<body>
<div id="site-content">
    <header class="site-header">

        <style>
            td {
                text-align:right;font-size:110%;border-bottom:1px solid black;
                padding-bottom: 3px;
                padding-top: 3px;


            }
        </style>
        <table width="100%">
            <tr>
                <td  width="30%" style="text-align:left;font-family: Glanchlo">
                    Paddy's Return </td><td width="40%" style="text-align:center;font-family: Glanchlo"> {{$setlist->konzert->title.", ".$setlist->konzert->start_t}}
                </td>
                <td width="30%" style="text-align:right;">
                    Page <span class="page"></span> of <span class="topage"></span>
                </td>
            </tr>
        </table>
    </header> <!-- .site-header -->

    @yield('content')

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