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
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/vendor/dataTables.foundation.min.js') }}"></script>
    <script type="text/javascript" language="javascript" class="init">
      $(document).ready(function() {

        $('#table').dataTable( {
            "columnDefs": [ {
              "targets": 'no-sort',
              "orderable": false,
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
          <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
          <img src="{{ URL::asset('img/logo.svg') }}" alt="Cocobrico"> <span>Administration Panel</span>
        </div>

        <div class="title-bar-right">
          <ul class="menu">
            <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </div>

      </div>


      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

        <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>

          <ul class="vertical dropdown menu" data-dropdown-menu>
            <li class="user">{{ $user->firstname }} {{ $user->lastname }}<em>Administrator</em></li>

            <li class="title"><i class="fa fa-cog"></i> Einstellungen</li>
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Zum Dashboard</a></li>
              <li><a href="{{ url('admin/users') }}"><i class="fa fa-user-secret"></i> Benutzer</a></li>
              <li><a href="{{ url('admin/raffles') }}"><i class="fa fa-trophy"></i> Gewinnspiele</a></li>
          </ul>

        </div>

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