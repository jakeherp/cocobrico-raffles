<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Order Cocobrico from Cocobrico Commercial as a wholesaler, retailer or other commercial customer.">
    <meta name="keywords" content="Cocobrico, Charcoal, Coconut, Indonesia, Europe, Shisha, Hookah, Coal">
    <meta name="publisher" content="Cocobrico Ltd">
    <meta name="author" content="PCServe Media Ltd">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('global.title') }}</title>
    <link rel="stylesheet" href="{{ URL::asset('css/foundation.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/dataTables.foundation.min.js') }}"></script>
    <script type="text/javascript" language="javascript" class="init">
      $(document).ready(function() {

        $('#table').dataTable( {
            "order": [ [ $('th.orderby').index(),  'desc' ] ],
            "columnDefs": [ {
              "targets": 'no-sort',
              "orderable": false
            } ],
            "language": {
              "url": "{{ URL::asset('lang/German.json') }}"
            }
        } );

      } );
    </script>
  </head>
  <body class="print">

    <header class="row">
      <div class="large-12 columns text-center">
        <h1><img src="{{ URL::asset('img/logo_black.png') }}" alt="{{ trans('global.cocobrico') }}"></h1>
      </div>
    </header>

    <div class="row">
      <div class="small-12 column">
        @yield('content')
      </div>
    </div>
    
  <script type="text/javascript" src="{{ URL::asset('js/vendor/what-input.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/foundation.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
  </body>
</html>