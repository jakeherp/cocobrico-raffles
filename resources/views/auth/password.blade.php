@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>Passwort vergessen</h3>
          <div class="success callout">
            <p>Wir haben Ihnen eine Email mit einem Zurücksetzungslink geschickt. Klicken Sie bitte auf den Zurücksetzungslink in dieser Email, um die Zurücksetzung Ihres Passwortes in die Wege zu leiten.</p>
            <a href="{{ url('password/'. $user->register_token ) }}">TEST</a>
          </div>
        </div>
      </div>
    </section>
	
@endsection