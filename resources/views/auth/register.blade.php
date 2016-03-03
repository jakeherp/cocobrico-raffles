@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>{{ trans('auth.signup') }}</h3>
          
          <div class="alert progress" role="progressbar" tabindex="0" aria-valuenow="20" aria-valuemin="0" aria-valuetext="25 percent" aria-valuemax="100">
            <span class="progress-meter" style="width: 33%"></span>
          </div>

          @include ('errors.list')

            {!! Form::open(['url' => 'register', 'method' => 'post', 'files' => true]) !!}
              {!! Form::hidden('_method', 'PUT', []) !!}
              {!! Form::hidden('register_token', $user->register_token, []) !!}
              <div class="row">
                <div class="large-12 columns">          
    				          <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                        {!! Form::email('email', $user->email, ['class' => 'input-group-field', 'placeholder' => trans('auth.email'), 'readonly']) !!}
                      </div>
                      <label>
                      	{{ trans('auth.choosepassword') }}
                        <div class="input-group">
                          <span class="input-group-label"><i class="fa fa-lock"></i></span>
                          {!! Form::password('password', ['id' => 'passwordInput', 'class' => 'input-group-field', 'placeholder' => trans('auth.password')]) !!}
                        </div>
                        <div id="password" class="callout warning">
                        </div>
                      </label>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-lock"></i></span>
                        {!! Form::password('password_2', ['class' => 'input-group-field', 'placeholder' => trans('auth.passwordrepeat')]) !!}
                      </div>
                      <label>
                        Persönliche Daten
                        <div class="input-group">
                         <span class="input-group-label"><i class="fa fa-user"></i></span>
                         {!! Form::text('firstname', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.firstname')]) !!}
                        </div>
                        <div id="password" class="callout warning">
                        </div>
                      </label>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-user"></i></span>
                        {!! Form::text('lastname', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.lastname')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-phone"></i></span>
                        {!! Form::text('phone', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.phone')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-birthday-cake"></i></span>
                        {!! Form::date('birthday', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.birthday')]) !!}
                      </div>
                      <label>
                        Weitere Informationen
                      </label>
                      <div class="input-group">
                         <span class="input-group-label"><i class="fa fa-home"></i></span>
                         {!! Form::text('address1', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.address1')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-home"></i></span>
                        {!! Form::text('address2', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.address2')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-building"></i></span>
                        {!! Form::text('zipcode', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.postcode')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-map"></i></span>
                        {!! Form::text('city', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.city')]) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-globe"></i></span>
                        {!! Form::select('country', $countries, null, ['class' => 'input-group-field']) !!}
                      </div>
                      <div class="input-group">
                        <span class="input-group-label"><i class="fa fa-phone"></i></span>
                        {!! Form::text('fax', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.fax')]) !!}
                      </div>
                      <label>
                        Profilbild
                      </label>
                      <em>Die Teilnahme an einigen Gewinnspielen erfordert ein Foto von dir.</em>
                      <div class="input-group">
                        {!! Form::file('profilePicture'); !!}
                      </div>
                    {!! Form::submit(trans('auth.continue') . ' &raquo;', ['class' => 'button alert']) !!}
                    </div>
                  </div>
                                
                </div>
              </div>
            {!! Form::close() !!}
            
        </div>
      </div>
    </section>

    <script>
      $(document).ready(function(){
        $('#passwordInput').on('input',function(e){
          var val = $(this).val();
          var error = '';
          if((val.length < 8) || !(val.match(/[A-Z]/)) || !(val.match(/[a-z]/)) || !(val.match(/\d/))){
            if(val.length < 8){
              error = '<p>{{ trans('auth.rule1') }}</p>';
            }
            if(!(val.match(/[A-Z]/))){
              error = error + '<p>{{ trans('auth.rule2') }}</p>';
            }
            if(!(val.match(/[a-z]/))){
              error = error + '<p>{{ trans('auth.rule3') }}</p>';
            }
            if(!(val.match(/\d/))){
              error = error + '<p>{{ trans('auth.rule4') }}</p>';
            }
            $('#password').show('slow');
          }
          else{
             $('#password').hide('slow');
          }
          $('#password').html(error);
        });
      });
    </script>
	
@endsection