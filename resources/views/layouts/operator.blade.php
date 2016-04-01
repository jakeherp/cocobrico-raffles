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
    <title>{{ trans('global.operator') }}</title>
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
  <body>
    <div class="off-canvas-wrapper">

      <div class="title-bar">

        <div class="top-bar-left">
          <img src="{{ URL::asset('img/logo.svg') }}" alt="Cocobrico"> <span>Moderation Panel</span>
        </div>

        <div class="title-bar-right">
          <ul class="menu">
            <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </div>

      </div>


      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

        <div class="off-canvas-content" data-off-canvas-content>
          <div class="row column">

            <section class="row" id="content">
              @yield('content')
            </section>

            <footer class="row">
              <div class="large-12 columns text-center">
                &copy; <?=date("Y");?> {{ trans('global.company') }}
              </div>
            </footer>

          </div>
        </div>

      </div>
    </div>

  <script type="text/javascript" src="{{ URL::asset('js/vendor/what-input.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/foundation.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

  </body>
</html>