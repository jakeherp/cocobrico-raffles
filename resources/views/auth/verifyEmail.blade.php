@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>Bitte bestätige deine Email-Adresse</h3>
          <div class="success callout">
            <p>Wir haben eine Bestätigungsmail an deine Adresse {{ $user->email }} geschickt. Bitte klicke auf den darin enthaltenen Link, um deine Registrierung fortzusetzen. </p>
            <button class="button alert" id="resendEmailButton" userId="{{ $user->id }}">Nochmal senden</button>
          </div>
        </div>
      </div>
    </section>

    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
      $(document).ready(function(){

        $('#resendEmailButton').click( function(){
          var user_id = $('#resendEmailButton').attr('userId');
          $.ajax({
            url: 'email',
            type: "get",
            data: {'id': user_id},
            success: function(data){
              $('#resendEmailButton').prop('disabled', true);
              $('#resendEmailButton').removeClass('alert');
              $('#resendEmailButton').text('Die Email wurde erneut versendet!')
            },
            error: function(data){
              alert('ERROR');
            }
          });
        });

      });
    </script>
	
@endsection