@extends('layouts.admin')

@section('content')

<section class="row" id="content">

  	<div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-envelope"></i> Unbeantwortete Nachrichten</h1>
          <div class="callout">

      	  <a href="#" class="divlink"><div class="row">
	      	  <div class="medium-1 small-2 columns">
	      		<img src="http://placehold.it/50x50" style="border-radius: 50%; margin-right: 1rem;">
	      	  </div>
	      	  <div class="medium-8 small-7 columns">
	      		<strong>Max Mustermann</strong>
	      		<p>Lorem ipsum dolor sit amet ...</p>
	      	  </div>
	      	  <div class="medium-3 small-3 columns text-right">
	      	  	<em>24.03.2016 15:23</em>
	      	  </div>
	      </div></a>
	      </div>
        </div>
      </div>
      <div class="row">
    	<div class="large-6 medium-6 small-12 columns"><h1><i class="fa fa-user"></i>Neue Benutzer</h1>
    	</div>
    	<div class="large-6 medium-6 small-12 columns"><h1><i class="fa fa-tag"></i>Zuletzt verwendete Codes</h1>
    	</div>
    </div>

</section>

@endsection