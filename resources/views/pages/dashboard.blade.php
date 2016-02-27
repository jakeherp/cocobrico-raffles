@extends('layouts.app')

@section('content')
    
    <section class="row" id="content">

        @foreach($raffles as $raffle)
          <div class="large-6 small-12 column">
            <div class="callout">
              <h3>{{ $raffle->title }}</h3>
              {{ $raffle->body }}

              {!! Form::open(['url' => 'dashboard', 'method' => 'post', 'files' => true]) !!}
                {!! Form::hidden('id', $raffle->id, []) !!}

                @if($raffle->imageReq == 1)
                  <div class="callout">
                    <p>Die Teilnahme am Gewinnspiel erfordert einen Dateiupload:</p>
                    {!! Form::file('file'); !!}
                  </div>
                @endif
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