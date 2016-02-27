@extends('layouts.app')

@section('content')
    
    <section class="row" id="content">

      <div class="large-12 column">
        <h1><i class="fa fa-trophy"></i> Verfügbare Gewinnspiele</h1>
      </div>

      @foreach($raffles as $raffle)
        <div class="large-6 small-12 column">
          <div class="callout">
            <h3>{{ $raffle->title }}</h3>
            {{ $raffle->body }}

            {!! Form::open(['url' => 'dashboard', 'method' => 'post']) !!}
              {!! Form::hidden('id', $raffle->id, []) !!}
              <button class="alert button" 
              @if($user->hasRaffle($raffle->id))
                disabled>Bereits angemeldet
              @else
                role="submit">Teilnehmen
              @endif
              </button>
            {!! Form::close() !!}
          </div>
        </div>
      @endforeach

    </section>
    
@endsection