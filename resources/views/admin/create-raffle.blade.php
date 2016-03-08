@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-trophy"></i> Aktion hinzufügen</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/raffles/create', 'method' => 'post', 'files' => true]) !!}
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
              {!! Form::date('end', null, ['id' => 'endTimeInput', 'class' => 'input-group-field', 'placeholder' => 'End-Zeitpunkt']) !!}
              <div class="input-group-button">
                {!! Form::hidden('endState', '1', ['id' => 'endTimeState']) !!}
                <a id="endTimeButton" class="button success">Deaktivieren</a>
              </div>
            </div>
          </label>
          <label>
            Maximale Teilnehmeranzahl
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-group"></i></span>
              {!! Form::number('maxp', 0, ['id' => 'maxpInput', 'disabled' => 'true', 'class' => 'input-group-field', 'placeholder' => 'Maximale Teilnehmeranzahl']) !!}
              <div class="input-group-button">
                {!! Form::hidden('maxpState', '0', ['id' => 'maxpState']) !!}
                <a id="maxpButton" class="button alert">Aktivieren</a>
              </div>
            </div>
          </label>
          <label>
            Aktionsgrafik (Bilddatei im Format JPG, PNG, GIF; Format: 700 x 400 Pixel)
            <div class="input-group">
              {!! Form::file('rafflePicture'); !!}
            </div>
          </label>
          <h4>Optionen</h4>
          <label>
            <div class="input-group">
              <i class="fa fa-upload"></i> 
              {!! Form::checkbox('imageReq', '1') !!} Der Benutzer muss ein Profilbild besitzen.
            </div>
          </label>
          <label>
            <div class="input-group">
              <i class="fa fa-child"></i> 
              {!! Form::checkbox('legalAgeReq', '1') !!} Der Benutzer muss 18 Jahre alt sein.
            </div>
          </label>
          <label>
            <div class="input-group">
              <i class="fa fa-envelope"></i> 
              {!! Form::checkbox('sendPdf', '1') !!} Teilnehmer erhalten eine Bestätigungs-PDF.
            </div>
          </label>
          {!! Form::submit('Aktion erstellen', ['class' => 'button alert']) !!}
		  {!! Form::close() !!}
        </div>
      </div>

    </section>

    <script>
      $(document).ready(function() {
          $('#endTimeButton').click( function() {
            handleEndTime(this);
          });

          $('#maxpButton').click( function() {
            handleMaxp(this);
          });
      });

      function handleEndTime(obj){
        var state = $('#endTimeState').val();
        if(state == 1){
          $(obj).removeClass('success');
          $(obj).addClass('alert');
          $(obj).text('Aktivieren');
          $('#endTimeInput').attr('disabled', true);
          $('#endTimeState').val(0);
          state = 0;
        }
        else{
          $(obj).addClass('success');
          $(obj).removeClass('alert');
          $(obj).text('Deaktivieren');
          $('#endTimeInput').attr('disabled', false);
          $('#endTimeState').val(1);
          state = 1;
        }
      }

      function handleMaxp(obj){
        var state = $('#maxpState').val();
        if(state == 1){
          $(obj).removeClass('success');
          $(obj).addClass('alert');
          $(obj).text('Aktivieren');
          $('#maxpInput').attr('disabled', true);
          $('#maxpState').val(0);
          state = 0;
        }
        else{
          $(obj).addClass('success');
          $(obj).removeClass('alert');
          $(obj).text('Deaktivieren');
          $('#maxpInput').attr('disabled', false);
          $('#maxpState').val(1);
          state = 1;
        }
      }
    </script>
    
@endsection