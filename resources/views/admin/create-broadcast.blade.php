@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-microphone"></i> Broadcast hinzufügen</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/broadcasts/create', 'method' => 'post']) !!}
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('headline', null, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::textarea('text', null, ['class' => 'input-group-field', 'placeholder' => 'Text']) }}
          </div>
          <label>
            Ablauf-Datum
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
              {!! Form::date('expiryDate', null, ['class' => 'input-group-field', 'placeholder' => 'Ablauf-Datum']) !!}
            </div>
          </label>
          <label>
            Hintergrund-Farbe
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-paint-brush"></i></span>
              <select class="input-group-field" name="slug">
                <option value="secondary">Weiß</option>
                <option value="primary">Grau</option>
                <option value="success">Grün</option>
                <option value="warning">Gelb</option>
                <option value="alert">Rot</option>
              </select>
            </div>
          </label>
          {!! Form::submit('Broadcast erstellen', ['class' => 'button alert']) !!}
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection