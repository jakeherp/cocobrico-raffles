@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Email hinzufügen</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/emails/create', 'method' => 'post']) !!}
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                {!! Form::text('email', 'noreply@cocobrico.com', ['class' => 'input-group-field', 'placeholder' => 'Absender-Email']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                {!! Form::text('from', 'Cocobrico', ['class' => 'input-group-field', 'placeholder' => 'Absender-Name']) !!}
          </div>
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('subject', null, ['class' => 'input-group-field', 'placeholder' => 'Betreff']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('body', null, ['class' => 'input-group-field', 'placeholder' => 'Text']) }}
          </div>
          <p>Verwendbare Variablen: <span class="label">[date]</span> <span class="label">[firstname]</span> <span class="label">[lastname]</span> <span class="label">[email]</span> <span class="label">[birthday]</span> <span class="label">[created_at]</span> <span class="label">[actionTitle]</span> <span class="label">[actionBody]</span></p>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::text('description', null, ['class' => 'input-group-field', 'maxlength' => '100', 'placeholder' => 'Beschreibung (Wird nicht in der Email angezeigt!']) }}
          </div>
          <label>
            Emailtyp
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-envelope"></i></span>
              <select class="input-group-field" id="typeSelect" name="slug">
                <option value="confirmRaffle">Teilnahmebestätigung</option>
                <option value="confirmRaffleNoPdf">Teilnahmebestätigung (Ohne PDF)</option>
                <option value="confirmCode">Gewinncode-Bestätigung</option>
                <option value="confirmManual">Manuelle Gewinn-Bestätigung</option>
              </select>
            </div>
          </label>
          {!! Form::submit('Email erstellen', ['class' => 'button alert']) !!}
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection