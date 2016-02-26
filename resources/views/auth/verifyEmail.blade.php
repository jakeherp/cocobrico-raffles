@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>{{ trans('auth.activateemail') }}</h3>
          <div class="success callout">
            <p>{!! trans('auth.activateemaildesc', ['email' => $user->email]) !!}</p>
            <a href="{{ url('register/'.$user->register_token) }}">TEST</a>
          </div>
        </div>
      </div>
    </section>
	
@endsection