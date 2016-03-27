@extends('layouts.operator')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
        {{ $member->firstname }} {{ $member->lastname }} {{ $member->email }}
  	</div>
</section>

@endsection