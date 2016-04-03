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
                    <span class="input-group-label"><i class="fa fa-tag"></i></span>
                    {!! Form::text('searchCode', null, ['class' => 'input-group-field', 'placeholder' => 'Bestätigungs- oder Teilnahmecode']) !!}
                </div>
	    		{!! Form::submit('Suchen', ['class' => 'large expanded alert button']) !!}
	    	{!! Form::close() !!}
	    	<a class="success button" id="toggleUserSearchButton"><i class="fa fa-search"></i></a>
	    </div>
	    <div class="callout text-center" id="userSearchCallout">
	    	{!! Form::open(['url' => 'operator/search', 'method' => 'post']) !!}
	    		<div class="input-group">
                    <span class="input-group-label"><i class="fa fa-user"></i></span>
                    {!! Form::text('searchUser', null, ['class' => 'input-group-field', 'placeholder' => 'Suchbegriff']) !!}
                </div>
	    		{!! Form::submit('Suchen', ['class' => 'large expanded alert button']) !!}
	    	{!! Form::close() !!}
	    </div>
  	</div>

</section>

<script>
    $(document).ready(function() {
    	$('#userSearchCallout').hide();

    	$('#toggleUserSearchButton').click(function(){
    		$('#userSearchCallout').show('slow');
    	});
    });
</script>

@endsection