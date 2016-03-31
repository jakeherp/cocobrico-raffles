@extends('layouts.operator')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
        @foreach($members as $member)
        <a href="{{ URL('operator/'.$member->id) }}">
        	<div class="callout">
                @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                    <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover; float:left; margin-right:1em"></div>
                @endif
        		<h5 style="display:inline-block;margin-right:1em;">
	        		@if($member->firstname == '' && $member->lastname == '')
	                    {{ $member->email }}
	                @else
	                    {{ $member->firstname }} {{ $member->lastname }}
	                @endif
	            </h5>
                <h6 style="display:inline-block">{{}}</h6>
        	</div>
        </a>
        @endforeach
  	</div>
</section>

@endsection