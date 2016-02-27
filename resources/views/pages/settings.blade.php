@extends('layouts.app')

@section('content')

    <section class="row" id="content">

	    <div class="large-12 column">
        
      	<h1><i class="fa fa-cog"></i> Settings</h1>
      </div>

      <div class="large-8 medium-6 small-12 columns">
        <div class="callout">
          <div class="row">
            <div class="large-12 column">
              <h4>Gewinnspiele</h4>

            </div>
          </div>
          <div class="row"> 
         
          </div>
        </div>
      </div>
      <div class="large-4 medium-6 small-12 columns">
        <div class="callout">
          <div class="row">
            <div class="large-12 column">
              <h4>Account Details</h4>
              <strong>Name:</strong> {{ $user->firstname }} {{ $user->lastname }}<br>
              <strong>Email:</strong> {{ $user->email }}<br>
              <strong>Password:</strong> ********<br>
              <a 
                class="tiny secondary button pull-right" 
                data-tooltip aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Bearbeiten" 
                data-open="editProfileModal" 
              >Bearbeiten</a>
              <a href="" class="tiny secondary button" title="Passwort ändern">Passwort ändern</a>
            </div>
          </div>
        </div>
      </div>

    </section>

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
                  {!! Form::select('country', $countries, $user->address->country_id) !!}
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

@endsection