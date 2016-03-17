@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> PDFs für Email <u>{{ $email->subject }}</u></h1>
        <p>{{ $email->description }}</p>
        @if($email->slug == 'confirmRaffleNoPdf')
          <div class="callout alert">
            <p>Der Typ der Email ist mit "Ohne PDF" angegeben. Gehe sicher, dass du dieser Email wirklich eine PDF zuweisen möchtest!</p>
          </div>
        @endif

        @include ('errors.list')
        
        <div class="callout">
		  {!! Form::open(['url' => 'admin/emails/pdf', 'method' => 'post', 'files' => true]) !!}
        {!! Form::hidden('id', $email->id) !!}
        @if(count($email->confirmations) > 0)
          <?php 
            $i = 0;
          ?>
          @foreach($email->confirmations as $attachement)
              <?php
                $i++;
              ?>
              <div class="input-group">
                <span class="input-group-label"><i class="fa fa-file-pdf-o"></i></span>
                <select class="input-group-field insertAttachement" name="attachement_{{ $i }}">
                  <option value="0">- Kein Anhang -</option>
                  @foreach($confirmations as $confirmation)
                    <option value="{{ $confirmation->id }}"

                    @if($attachement->id == $confirmation->id)
                      selected
                    @endif

                    >{{ $confirmation->description }}</option>
                  @endforeach
                </select>
              </div>
          @endforeach
        @else
              <div class="input-group">
                <span class="input-group-label"><i class="fa fa-file-pdf-o"></i></span>
                <select class="input-group-field insertAttachement" name="attachement_1">
                  <option value="0">- Kein Anhang -</option>
                  @foreach($confirmations as $confirmation)
                    <option value="{{ $confirmation->id }}">{{ $confirmation->description }}</option>
                  @endforeach
                </select>
              </div>
        @endif
          <div id="nextAttachement"></div>
        {!! Form::hidden('counter', 0, ['id' => 'pdfCounter']) !!}
        {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
        <a class="button secondary success" id="addAttachement">Anhang hinzufügen</a>
        <a class="button secondary" href="{{ URL('admin/emails') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>

    <script>
      $(document).ready(function() {
        var counter = $(".insertAttachement").length;
        $('#pdfCounter').val(counter);
        $('#addAttachement').click( function() {
          if( $("option[value='0']:selected").length ){
            alert('Es sind Felder vorhanden, in denen noch kein Anhang ausgewählt wurde.');
          }
          else{
            counter++;
            $('#pdfCounter').val(counter);
            $('#nextAttachement').replaceWith('<div class="input-group"><span class="input-group-label"><i class="fa fa-file-pdf-o"></i></span><select class="input-group-field insertAttachement" name="attachement_'+counter+'"><option value="0">- Kein Anhang -</option>@foreach($confirmations as $confirmation)<option value="{{ $confirmation->id }}">{{ $confirmation->description }}</option>@endforeach</select></div><div id="nextAttachement"></div>');
          }
        });
      });
    </script>
    
@endsection