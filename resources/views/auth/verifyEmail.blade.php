@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>Bitte bestätige deine Email-Adresse</h3>
          <div class="success callout">
            <p>Wir haben eine Bestätigungsmail an deine Adresse {{ $user->email }} geschickt. Bitte klicke auf den darin enthaltenen Link, um deine Registrierung fortzusetzen.</p>
          </div>
        </div>
      </div>
    </section>
	
@endsection