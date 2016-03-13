@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-tag"></i> Codes hinzufügen zu {{ $raffle->title }}</h1>
        <div class="callout">
		      {!! Form::open(['url' => 'admin/codes/create', 'method' => 'post', 'files' => true]) !!}
            {!! Form::hidden('raffle_id', $raffle->id) !!}
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-barcode"></i></span>
                {!! Form::number('amount', null, ['class' => 'input-group-field', 'placeholder' => 'Anzahl Codes', 'min' => '1']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
                {{ Form::text('remark', null, ['class' => 'input-group-field', 'placeholder' => 'Kommentar']) }}
          </div>
          <label>
            Ablaufdatum
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-calendar"></i></span>
                  {!! Form::date('endtime', date('Y-m-d', $raffle->end), ['class' => 'input-group-field', 'placeholder' => 'End-Zeitpunkt']) !!}
            </div>
          </label>
              {!! Form::submit('Codes generieren', ['class' => 'button alert']) !!}
		      {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection