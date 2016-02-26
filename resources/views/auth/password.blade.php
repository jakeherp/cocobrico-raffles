@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>Passwort vergessen</h3>
          <div class="success callout">
            <p>Hier klicken um passwort kot:</p>
            {!! Form::open(['url' => 'password', 'method' => 'post']) !!}
              <input type="hidden" name="userId" value="{{ $user->id }}">
              <button>Psswort zrücksetzn</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>
	
@endsection