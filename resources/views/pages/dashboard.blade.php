@extends('layouts.app')

@section('content')
    
    <section id="content">

      <div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-trophy"></i> Verfügbare Gewinnspiele</h1>
        </div>
      </div>
      <div class="row">
      @foreach($raffles as $raffle)
        <div class="large-6 small-12 columns">
          <div class="callout">
            <h3>{{ $raffle->title }}</h3>
            {{ $raffle->body }}

            {!! Form::open(['url' => 'dashboard', 'method' => 'post', 'files' => true]) !!}
                {!! Form::hidden('id', $raffle->id, []) !!}

                @if($raffle->imageReq == 1)
                  <div class="callout">
                    <p>Die Teilnahme am Gewinnspiel erfordert ein Profilbild.</p>
                    @if(($file = $user->files()->where('slug','profile_img')->first()) != null)
                      <img src="{{ URL::asset($file->path) }}">
                    @else
                      <a href="settings">Bild hochladen</a>
                    @endif
                  </div>
                @endif
                <button class="alert button" 
                @if($user->hasRaffle($raffle->id))
                  disabled>Bereits angemeldet
                @elseif($raffle->imageReq == 1 && $file == null)
                  disabled>Profilbild benötigt
                @else
                  role="submit">Teilnehmen
                @endif
                </button>
              {!! Form::close() !!}
          </div>
        </div>
      @endforeach
      </div>

    </section>
    
@endsection