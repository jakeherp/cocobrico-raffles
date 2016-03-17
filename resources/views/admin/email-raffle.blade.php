@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Emails für Aktion <u>{{ $raffle->title }}</u></h1>

        @include ('errors.list')
        
        <div class="callout">
		  {!! Form::open(['url' => 'admin/raffles/emails', 'method' => 'post', 'files' => true]) !!}
      {!! Form::hidden('id', $raffle->id) !!}
          <label>
            Teilnahmebestätigung (Mit PDF)
            <div class="input-group">
              <?php
                $setEmail = $raffle->emails()->where('slug','confirmRaffle')->first();
              ?>
              <span class="input-group-label"><i class="fa fa-envelope"></i></span>
              <select class="input-group-field" name="confirmRaffle">
                @foreach($emails->where('slug','confirmRaffle') as $email)
                  <option value="{{ $email->id }}"

                  @if($setEmail != null && $setEmail->id == $email->id)
                    selected
                  @endif

                  >{{ $email->description }}</option>
                @endforeach
              </select>
            </div>
          </label>
          <label>
            Teilnahmebestätigung (Ohne PDF)
            <div class="input-group">
              <?php
                $setEmail = $raffle->emails()->where('slug','confirmRaffleNoPdf')->first();
              ?>
              <span class="input-group-label"><i class="fa fa-envelope"></i></span>
              <select class="input-group-field" name="confirmRaffleNoPdf">
                @foreach($emails->where('slug','confirmRaffleNoPdf') as $email)
                  <option value="{{ $email->id }}"

                  @if($setEmail != null && $setEmail->id == $email->id)
                    selected
                  @endif

                  >{{ $email->description }}</option>
                @endforeach
              </select>
            </div>
          </label>
          <label>
            Bestätgungsemail für Gewinncode
            <div class="input-group">
              <?php
                $setEmail = $raffle->emails()->where('slug','confirmCode')->first();
              ?>
              <span class="input-group-label"><i class="fa fa-envelope"></i></span>
              <select class="input-group-field" name="confirmCode">
                @foreach($emails->where('slug','confirmCode') as $email)
                  <option value="{{ $email->id }}"

                  @if($setEmail != null && $setEmail->id == $email->id)
                    selected
                  @endif

                  >{{ $email->description }}</option>
                @endforeach
              </select>
            </div>
          </label>
          <label>
            Bestätigungsemail für manuelle Bestätigung
            <div class="input-group">
              <?php
                $setEmail = $raffle->emails()->where('slug','confirmManual')->first();
              ?>
              <span class="input-group-label"><i class="fa fa-envelope"></i></span>
              <select class="input-group-field" name="confirmManual">
                @foreach($emails->where('slug','confirmManual') as $email)
                  <option value="{{ $email->id }}"

                  @if($setEmail != null && $setEmail->id == $email->id)
                    selected
                  @endif

                  >{{ $email->description }}</option>
                @endforeach
              </select>
            </div>
          </label>
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection