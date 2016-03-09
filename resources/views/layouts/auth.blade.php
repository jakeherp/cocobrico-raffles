<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Order Cocobrico from Cocobrico Commercial as a wholesaler, retailer or other commercial customer.">
    <meta name="keywords" content="Cocobrico, Charcoal, Coconut, Indonesia, Europe, Shisha, Hookah, Coal">
    <meta name="publisher" content="Cocobrico Europe Ltd">
    <meta name="author" content="PCServe Media Ltd">

    <title>{{ trans('global.title') }}</title>

    <link rel="stylesheet" href="{{ URL::asset('css/foundation.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    <link rel="apple-touch-icon" href="{{ URL::asset('img/touch-icon-iphone.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('img/touch-icon-ipad.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('img/touch-icon-iphone-retina.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('img/touch-icon-ipad-retina.png') }}">
    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.png') }}" type="image/png">

    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.min.js') }}"></script>
  </head>
  <body>

    <header class="row">
      <div class="large-12 columns text-center">
        <h1><img src="{{ URL::asset('img/logo.svg') }}" alt="{{ trans('global.cocobrico') }}">{{ trans('global.commercialcustomers') }}</h1>
      </div>
    </header>

	   @yield('content')
	    
    <footer class="row">
      <div class="large-12 columns text-center">
        &copy; <?=date("Y");?> {{ trans('global.company') }} | <a href="{{ url('impressum') }}" style="color:#fff;">Impressum / Datenschutz</a>
      </div>
    </footer>
	
  	<script type="text/javascript" src="{{ URL::asset('js/vendor/what-input.min.js') }}"></script>
  	<script type="text/javascript" src="{{ URL::asset('js/foundation.min.js') }}"></script>
  	<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-74888433-1', 'auto');
      ga('send', 'pageview');

    </script>
  </body>
</html>
