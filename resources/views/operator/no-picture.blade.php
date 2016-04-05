@extends('layouts.operator')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
      <div class="callout">
       <p>Die Teilnahme an der Aktion {{ $raffle->title }} erfordert ein Profilbild. Der Benutzer hat kein Profilbild hochgeladen. Soll er dennoch aktiviert werden?</p>
       {!! Form::open(['url' => 'operator/register', 'method' => 'post']) !!}
            {!! Form::hidden('_method', 'PUT', []) !!}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
            <input type="hidden" name="nopic" value="true">
            <button class="warning button"><i class="fa fa-check-square-o"></i> Registrieren</button>
        {!! Form::close() !!}
        <a href="{{ URL('operator/'.$user->id) }}" class="secondary button">Zurück</a>
      </div>
    </div>
</section>

@endsection