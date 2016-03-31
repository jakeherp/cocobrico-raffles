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

    <script type="text/javascript" src="{{ URL::asset('js/qr/grid.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/version.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/detector.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/formatinf.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/errorlevel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/bitmap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/datablock.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/bmparser.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/datamask.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/rsdecoder.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/gf256poly.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/gf256.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/decoder.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/qrcode.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/findpat.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/alignpat.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/qr/databr.js') }}"></script>

    <script type="text/javascript">
    var gCtx = null;
      var gCanvas = null;

      var imageData = null;
      var ii=0;
      var jj=0;
      var c=0;
      
      
    function dragenter(e) {
      e.stopPropagation();
      e.preventDefault();
    }

    function dragover(e) {
      e.stopPropagation();
      e.preventDefault();
    }
    function drop(e) {
      e.stopPropagation();
      e.preventDefault();

      var dt = e.dataTransfer;
      var files = dt.files;

      handleFiles(files);
    }

    function handleFiles(f)
    {
      var o=[];
      for(var i =0;i<f.length;i++)
      {
        var reader = new FileReader();

          reader.onload = (function(theFile) {
            return function(e) {
              qrcode.decode(e.target.result);
            };
          })(f[i]);

          // Read in the image file as a data URL.
          reader.readAsDataURL(f[i]); }
    }
      
    function read(a)
    {
      alert(a);
    } 
      
    function load()
    {
      initCanvas(640,480);
      qrcode.callback = read;
      qrcode.decode("meqrthumb.png");
    }

    function initCanvas(ww,hh)
      {
        gCanvas = document.getElementById("qr-canvas");
        gCanvas.addEventListener("dragenter", dragenter, false);  
        gCanvas.addEventListener("dragover", dragover, false);  
        gCanvas.addEventListener("drop", drop, false);
        var w = ww;
        var h = hh;
        gCanvas.style.width = w + "px";
        gCanvas.style.height = h + "px";
        gCanvas.width = w;
        gCanvas.height = h;
        gCtx = gCanvas.getContext("2d");
        gCtx.clearRect(0, 0, w, h);
        imageData = gCtx.getImageData( 0,0,320,240);
      }

      function passLine(stringPixels) { 
        //a = (intVal >> 24) & 0xff;

        var coll = stringPixels.split("-");
      
        for(var i=0;i<320;i++) { 
          var intVal = parseInt(coll[i]);
          r = (intVal >> 16) & 0xff;
          g = (intVal >> 8) & 0xff;
          b = (intVal ) & 0xff;
          imageData.data[c+0]=r;
          imageData.data[c+1]=g;
          imageData.data[c+2]=b;
          imageData.data[c+3]=255;
          c+=4;
        } 

        if(c>=320*240*4) { 
          c=0;
                gCtx.putImageData(imageData, 0,0);
        } 
      } 

            function captureToCanvas() {
        flash = document.getElementById("embedflash");
        flash.ccCapture();
        qrcode.decode();
            }
    </script>

  </head>
  <body onload="load()">
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