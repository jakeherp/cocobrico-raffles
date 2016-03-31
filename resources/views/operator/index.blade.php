@extends('layouts.operator')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
	  	<h1><i class="fa fa-search"></i> Teilnehmersuche</h1>
	  	<p>Geben Sie den Namen, den Geburtstag, den Reservierungscode oder den Gewinncode eines Benutzers ein.</p>
	  	@if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
	    <div class="callout text-center">
	    	{!! Form::open(['url' => 'operator/search', 'method' => 'post']) !!}
	    		<div class="input-group">
                    <span class="input-group-label"><i class="fa fa-user"></i></span>
                    {!! Form::text('search', null, ['class' => 'input-group-field', 'placeholder' => 'Suchbegriff']) !!}
                </div>
	    		{!! Form::submit('Suchen', ['class' => 'large expanded alert button']) !!}
	    	{!! Form::close() !!}
	    </div>
  	</div>

  	<div class="large-12 column">
	  	<div class="callout">
		  	<object  id="iembedflash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="320" height="240">
		  		<param name="movie" value="camcanvas.swf" />
		  		<param name="quality" value="high" />
				<param name="allowScriptAccess" value="always" />
		  		<embed  allowScriptAccess="always"  id="embedflash" src="camcanvas.swf" quality="high" width="320" height="240" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" mayscript="true"  />
		    </object>
			<button class="alert button" onclick="captureToCanvas()">Capture</button><br>
			<canvas id="qr-canvas" width="640" height="480"></canvas>
  		</div>
  	</div>
</section>

@endsection