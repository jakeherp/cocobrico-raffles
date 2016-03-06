@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-trophy"></i> Gewinnspiel bearbeiten</h1>
        <div class="callout">
		  {!! Form::open(['url' => 'admin/raffles/save', 'method' => 'post', 'files' => true]) !!}
      {!! Form::hidden('_method', 'PUT', []) !!}
      {!! Form::hidden('register_token', $user->register_token, []) !!}
      {!! Form::hidden('id', $raffle->id) !!}
		  <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('title', $raffle->title, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('body', $raffle->body, ['class' => 'input-group-field', 'placeholder' => 'Beschreibung']) }}
          </div>
          <label>
            Start-Zeitpunkt
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('start', date('Y-m-d',$raffle->start), ['class' => 'input-group-field', 'placeholder' => 'Start-Zeitpunkt']) !!}
            </div>
          </label>
          <label>
            End-Zeitpunkt
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('end', date('Y-m-d',$raffle->end), ['class' => 'input-group-field', 'placeholder' => 'End-Zeitpunkt']) !!}
            </div>
          </label>
          <label>
            Aktionsgrafik
            <div class="input-group">
              {!! Form::file('rafflePicture'); !!}
            </div>
          </label>
          <h4>Optionen</h4>
          <label>
            <div class="input-group">
              <i class="fa fa-upload"></i>
              @if($raffle->imageReq == 1)
                {!! Form::checkbox('imageReq', '1', true) !!} Der Benutzer muss ein Profilbild besitzen.
              @else
                {!! Form::checkbox('imageReq', '1', false) !!} Der Benutzer muss ein Profilbild besitzen.
              @endif
            </div>
          </label>
          <label>
            <div class="input-group">
              <i class="fa fa-child"></i>
              @if($raffle->legalAgeReq == 1)
                {!! Form::checkbox('legalAgeReq', '1', true) !!} Der Benutzer muss 18 Jahre alt sein.
              @else
                {!! Form::checkbox('legalAgeReq', '1', false) !!} Der Benutzer muss 18 Jahre alt sein.
              @endif
            </div>
          </label>
          <label>
            <div class="input-group">
              <i class="fa fa-envelope"></i>
              @if($raffle->sendPdf == 1)
                {!! Form::checkbox('sendPdf', '1', true) !!} Teilnehmer erhalten eine Bestätigungs-PDF.
              @else
                {!! Form::checkbox('sendPdf', '1', false) !!} Teilnehmer erhalten eine Bestätigungs-PDF.
              @endif
            </div>
          </label>
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection