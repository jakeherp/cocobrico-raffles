@extends('layouts.app')

@section('content')
    
    <section id="content">

      <div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-trophy"></i> Verfügbare Gewinnspiele</h1>
        </div>
      </div>
      @if(session()->has('msg'))
        <div class="row">
          <div class="large-12 small-12 columns">
            <div class="callout {{ session('msgState') }}">
              <p>{{ session('msg') }}</p>
            </div>
          </div>
        </div>
      @endif
      <div class="row">
      @if((time() - $user->birthday) >= 567648000)
        @foreach($raffles as $raffle)
          <div class="large-6 small-12 columns">
            <div class="callout">
              <h3>{{ $raffle->title }}</h3>

                {!! Form::open(['url' => 'dashboard', 'method' => 'post', 'files' => true]) !!}
                    {!! Form::hidden('id', $raffle->id, []) !!}

                    @if($raffle->imageReq == 1)
                        @if(($file = $user->files()->where('slug','profile_img')->first()) == null)
                          <div class="callout alert">
                            <p>Die Teilnahme am Gewinnspiel erfordert ein Profilbild.</p>
                              <a href="settings">Bild hochladen</a>
                          </div>
                        @endif
                    @endif

                    <p>{{ $raffle->body }}</p>

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
      @else
        <div class="large-12 columns">
          <div class="callout alert">Gewinnspiele sind nur für Mitglieder über 18 Jahren zugänglich.</div>
        </div>
      @endif
      </div>

    </section>
    
@endsection