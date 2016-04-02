@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-microphone"></i> Broadcast hinzufügen</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/broadcasts/update', 'method' => 'post']) !!}
      {!! Form::hidden('_method', 'PUT', []) !!}
      {!! Form::hidden('id', $broadcast->id) !!}
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('headline', $broadcast->headline, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('text', $broadcast->text, ['class' => 'input-group-field', 'placeholder' => 'Text']) }}
          </div>
          <label>
            Ablauf-Datum
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('expiryDate', date('Y-m-d',$broadcast->expiryDate), ['class' => 'input-group-field', 'placeholder' => 'Ablauf-Datum']) !!}
            </div>
          </label>
          <label>
            Hintergrund-Farbe
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-paint-brush"></i></span>
              <select class="input-group-field" name="slug">
                <option value="secondary" @if($broadcast->slug == 'secondary') selected @endif>Weiß</option>
                <option value="primary" @if($broadcast->slug == 'primary') selected @endif>Grau</option>
                <option value="success" @if($broadcast->slug == 'success') selected @endif>Grün</option>
                <option value="warning" @if($broadcast->slug == 'warning') selected @endif>Gelb</option>
                <option value="alert" @if($broadcast->slug == 'alert') selected @endif>Rot</option>
              </select>
            </div>
          </label>
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!} <a class="button secondary" href="{{ URL('admin/broadcasts') }}">Zurück</a>
		  {!! Form::close() !!}

        </div>
      </div>

    </section>
    
@endsection