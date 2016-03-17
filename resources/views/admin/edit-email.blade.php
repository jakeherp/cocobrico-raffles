@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Email bearbeiten</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/emails', 'method' => 'post']) !!}
      {!! Form::hidden('_method', 'PUT', []) !!}
      {!! Form::hidden('id', $email->id) !!}
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                {!! Form::text('email', $email->email, ['class' => 'input-group-field', 'placeholder' => 'Absender-Email']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                {!! Form::text('from', $email->from, ['class' => 'input-group-field', 'placeholder' => 'Absender-Name']) !!}
          </div>
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('subject', $email->subject, ['class' => 'input-group-field', 'placeholder' => 'Betreff']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('body', $email->body, ['class' => 'input-group-field', 'placeholder' => 'Text']) }}
          </div>
          <p>Verwendbare Variablen: <span class="label">[date]</span> <span class="label">[firstname]</span> <span class="label">[lastname]</span> <span class="label">[email]</span> <span class="label">[birthday]</span> <span class="label">[created_at]</span> <span class="label">[actionTitle]</span> <span class="label">[actionBody]</span></p>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::text('description', $email->description, ['class' => 'input-group-field', 'maxlength' => '100', 'placeholder' => 'Beschreibung (Wird nicht in der Email angezeigt!']) }}
          </div>
          @if($email->standard != 1)
            <label>
              Emailtyp
              <div class="input-group">
                <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                <select class="input-group-field" id="typeSelect" name="slug">
                  <option value="confirmRaffle" @if($email->slug == 'confirmRaffle') selected @endif>Teilnahmebestätigung</option>
                  <option value="confirmRaffleNoPdf" @if($email->slug == 'confirmRaffleNoPdf') selected @endif>Teilnahmebestätigung (Ohne PDF)</option>
                  <option value="confirmCode" @if($email->slug == 'confirmCode') selected @endif>Gewinncode-Bestätigung</option>
                  <option value="confirmManual" @if($email->slug == 'confirmManual') selected @endif>Manuelle Gewinn-Bestätigung</option>
                </select>
              </div>
            </label>
          @endif
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
          <a class="button secondary" href="{{ URL('admin/emails') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection