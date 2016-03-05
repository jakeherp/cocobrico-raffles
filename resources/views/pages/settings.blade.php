@extends('layouts.app')

@section('content')

    <section class="row" id="content">

	    <div class="large-12 column">
      	<h1><i class="fa fa-cog"></i> Settings</h1>
      </div>

      @if ($errors->any())
          <div class="large-12 small-12 columns">
            <div class="callout alert">
              @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>
              @endforeach
            </div>
          </div>
      @endif

      @if(session()->has('msg'))
          <div class="large-12 small-12 columns">
            <div class="callout {{ session('msgState') }}">
              <p>{{ session('msg') }}</p>
            </div>
          </div>
      @endif

      <div class="large-8 medium-6 small-12 columns">
        <div class="callout">
          <h4>Profilbild</h4>
            {!! Form::open(['url' => 'settings/image', 'method' => 'post', 'files' => true]) !!}
                {!! Form::hidden('_method', 'PUT', []) !!}
                {!! Form::hidden('register_token', $user->register_token, []) !!}
                @if(($file = $user->files()->where('slug','profile_img')->first()) != null)
                  <img src="{{ URL::asset($file->path) }}" style="max-width:200px;">
                  <p>Profilbild ändern:</p>
                @else
                  <p>Profilbild hochladen:</p>
                @endif
                {!! Form::file('profilePicture'); !!}
                {!! Form::submit(trans('auth.continue') . ' &raquo;', ['class' => 'button alert']) !!}
            {!! Form::close() !!}
        </div>
      </div>
      <div class="large-4 medium-6 small-12 columns">
        <div class="callout">
          <div class="row">
            <div class="large-12 column">
            @if(count($user->raffles()->where('start','<=',time())->where('end','>=',time())->get()) > 0)
              <a 
                class="small alert button pull-right" 
                disabled
              >Bearbeiten</a>
            @else
              <a 
                class="small alert button pull-right" 
                aria-haspopup="true" 
                data-open="editProfileModal" 
              >Bearbeiten</a>
            @endif
              <h4>Benutzerkonto</h4>
              <strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}<br>
              <strong>Email:</strong> {{ $user->email }}<br>
              <strong>Passwort:</strong> ******** <a 
                class="tiny secondary button" 
                aria-haspopup="true" 
                data-open="changePasswordModal" 
                >ändern</a>
            </div>
          </div>
        </div>
      </div>

    </section>

      <!-- Modal for changing the password -->
      <div class="reveal" id="changePasswordModal" data-reveal>
        <h3>Passwort ändern</h3>
        {!! Form::open(['url' => 'settings/password', 'method' => 'post']) !!}
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="large-12 small-12 columns">
              <div class="callout">
                <label>
                  Password
                  {!! Form::password('password', ['id' => 'passwordInput', 'class' => 'input-group-field', 'placeholder' => trans('auth.password')]) !!}
                </label>
                <div id="password" class="callout warning">
                  </div>
                <label>
                  Passwort wiederholen
                  {!! Form::password('password_2', ['class' => 'input-group-field', 'placeholder' => trans('auth.passwordrepeat')]) !!}
                </label>
               </div>
              <button role="submit" class="alert button">Speichern</button>
              <button type="reset" class="secondary button" data-close>Abbrechen</button>
            </div>
        {!! Form::close() !!}
        <button class="close-button" data-close aria-label="Close reveal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal for editing the profile details -->
      <div class="reveal" id="editProfileModal" data-reveal>
        <h3>Profildaten Bearbeiten</h3>
        {!! Form::open(['url' => 'settings', 'method' => 'post']) !!}
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="large-12 small-12 columns">
              <div class="callout">
                <label>
                  Vorname
                  {!! Form::text('firstname', $user->firstname, ['placeholder' => 'Vorname']) !!}
                </label>
                <label>
                  Nachname
                  {!! Form::text('lastname', $user->lastname, ['placeholder' => 'Nachname']) !!}
                </label>
               </div>
               <div class="callout">
                <label>
                  Addressfeld 1
                  {!! Form::text('address1', $user->address->address1, ['placeholder' => trans('auth.address1')]) !!}
                </label>
                <label>
                  Addressfeld 2
                  {!! Form::text('address2', $user->address->address2, ['placeholder' => trans('auth.address2')]) !!}
                </label>
                <label>
                  Postleitzahl
                  {!! Form::text('zipcode', $user->address->zipcode, ['placeholder' => 'Postleitzahl']) !!}
                </label>
                <label>
                  Stadt
                  {!! Form::text('city', $user->address->city, ['placeholder' => trans('auth.city')]) !!}
                </label>
                <label>
                  Land
                  <select name="country" class="input-group-field">
                    <option value="80" @if($user->address->country_id == 80) selected @endif>Deutschland</option>
                    <option value="14" @if($user->address->country_id == 14) selected @endif>Österreich</option>
                    <option value="206" @if($user->address->country_id == 206) selected @endif>Schweiz</option>
                    <option value="80">-------------</option>
                    @foreach($countries as $country)
                      <option value="{{ $country->id }}" @if($user->address->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </label>
              </div>
               <div class="callout">
                <em>Wenn Sie Ihre Emailadresse ändern möchten, wenden Sie sich bitte an den Kundensupport.</em>
                <label>
                  Email
                  {!! Form::text('email', $user->email, ['placeholder' => trans('auth.email'), 'disabled']) !!}
                </label>
                <label>
                  Telefon
                  {!! Form::text('phone', $user->address->phone, ['placeholder' => trans('auth.phone')]) !!}
                </label>
                <label>
                  Fax
                  {!! Form::text('fax', $user->address->fax, ['placeholder' => trans('auth.fax')]) !!}
                </label>
              </div>
              <button role="submit" class="alert button">Speichern</button>
              <button type="reset" class="secondary button" data-close>Abbrechen</button>
            </div>
        {!! Form::close() !!}
        <button class="close-button" data-close aria-label="Close reveal" type="button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

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