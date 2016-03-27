@extends('layouts.operator')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
        @foreach($members as $member)
        	<div class="callout">
        		<h1>
	        		@if($member->firstname == '' && $member->lastname == '')
	                    {{ $member->email }}
	                @else
	                    {{ $member->firstname }} {{ $member->lastname }}
	                @endif
	            </h1>
        		@if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                    <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                @else
                    Kein Foto
                @endif
        	</div>
        @endforeach
  	</div>
</section>

@endsection