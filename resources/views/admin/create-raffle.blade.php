@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-trophy"></i> Gewinnspiel hinzufügen</h1>
        <div class="callout">
		  {!! Form::open(['url' => 'admin/raffles/create', 'method' => 'post']) !!}
		  <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('title', null, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('body', null, ['class' => 'input-group-field', 'placeholder' => 'Beschreibung']) }}
          </div>
          <label>
            Start-Zeitpunkt
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('start', null, ['class' => 'input-group-field', 'placeholder' => 'Start-Zeitpunkt']) !!}
            </div>
          </label>
          <label>
            End-Zeitpunkt
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('end', null, ['class' => 'input-group-field', 'placeholder' => 'End-Zeitpunkt']) !!}
            </div>
          </label>
          <label>
            Optionen
            <div class="input-group">
              <i class="fa fa-upload"></i>
              {!! Form::checkbox('imageReq', '1') !!} Der Benutzer muss ein Profilbild besitzen.
            </div>
          </label>
          {!! Form::submit('Gewinnspiel erstellen', ['class' => 'button alert']) !!}
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection