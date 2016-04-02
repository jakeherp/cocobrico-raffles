@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-trophy"></i> Aktion bearbeiten</h1>

        @include ('errors.list')
        
        <div class="callout">
		  {!! Form::open(['url' => 'admin/raffles/save', 'method' => 'post', 'files' => true]) !!}
      {!! Form::hidden('_method', 'PUT', []) !!}
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
              {!! Form::date('end', date('Y-m-d',$raffle->end), ['id' => 'endTimeInput', 'class' => 'input-group-field', 'placeholder' => 'End-Zeitpunkt']) !!}
              <div class="input-group-button">
                {!! Form::hidden('endState', $raffle->endState, ['id' => 'endTimeState']) !!}
                <a id="endTimeButton" class="button success">Deaktivieren</a>
              </div>
            </div>
          </label>
          <label>
            Event-Zeitpunkt
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('eventDate', date('Y-m-d',$raffle->eventDate), ['id' => 'eventDateInput', 'disabled' => 'true', 'class' => 'input-group-field', 'placeholder' => 'Event-Zeitpunkt']) !!}
              <div class="input-group-button">
                {!! Form::hidden('hasEventDate', $raffle->hasEventDate, ['id' => 'hasEventDate']) !!}
                <a id="eventDateButton" class="button alert">Aktivieren</a>
              </div>
            </div>
          </label>
          <label>
            Maximale Teilnehmeranzahl
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-group"></i></span>
              {!! Form::number('maxp', $raffle->maxp, ['id' => 'maxpInput', 'disabled' => 'true', 'class' => 'input-group-field', 'placeholder' => 'Maximale Teilnehmeranzahl']) !!}
              <div class="input-group-button">
                {!! Form::hidden('maxpState', $raffle->maxpState, ['id' => 'maxpState']) !!}
                <a id="maxpButton" class="button alert">Aktivieren</a>
              </div>
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
              <i class="fa fa-trophy"></i>
              @if($raffle->instWin == 1)
                {!! Form::checkbox('instWin', '1', true) !!} Alle Teilnehmer gewinnen automatisch.
              @else
                {!! Form::checkbox('instWin', '1', false) !!} Alle Teilnehmer gewinnen automatisch.
              @endif
            </div>
          </label>
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>

     <script>
      $(document).ready(function() {
          var endState = $('#endTimeState').val();
          var maxpState = $('#maxpState').val();
          var hasEventDate = $('#hasEventDate').val();

          if(endState == 1){
            $('#endTimeButton').removeClass('alert');
            $('#endTimeButton').addClass('success');
            $('#endTimeButton').text('Deaktivieren');
            $('#endTimeInput').attr('disabled', false);
          }
          else{
            $('#endTimeButton').removeClass('success');
            $('#endTimeButton').addClass('alert');
            $('#endTimeButton').text('Aktivieren');
            $('#endTimeInput').attr('disabled', true);
          }

          if(maxpState == 1){
            $('#maxpButton').removeClass('alert');
            $('#maxpButton').addClass('success');
            $('#maxpButton').text('Deaktivieren');
            $('#maxpInput').attr('disabled', false);
          }
          else{
            $('#maxpButton').removeClass('success');
            $('#maxpButton').addClass('alert');
            $('#maxpButton').text('Aktivieren');
            $('#maxpInput').attr('disabled', true);
          }

          if(hasEventDate == 1){
            $('#eventDateButton').removeClass('alert');
            $('#eventDateButton').addClass('success');
            $('#eventDateButton').text('Deaktivieren');
            $('#eventDateInput').attr('disabled', false);
          }
          else{
            $('#eventDateButton').removeClass('success');
            $('#eventDateButton').addClass('alert');
            $('#eventDateButton').text('Aktivieren');
            $('#eventDateInput').attr('disabled', true);
          }

          $('#endTimeButton').click( function() {
            handleEndTime(this);
          });

          $('#maxpButton').click( function() {
            handleMaxp(this);
          });

          $('#eventDateButton').click( function() {
            handleEventDate(this);
          });
      });

      function handleEventDate(obj){
        var state = $('#hasEventDate').val();
        if(state == 1){
          $(obj).removeClass('success');
          $(obj).addClass('alert');
          $(obj).text('Aktivieren');
          $('#eventDateInput').attr('disabled', true);
          $('#hasEventDate').val(0);
          state = 0;
        }
        else{
          $(obj).addClass('success');
          $(obj).removeClass('alert');
          $(obj).text('Deaktivieren');
          $('#eventDateInput').attr('disabled', false);
          $('#hasEventDate').val(1);
          state = 1;
        }
      }

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