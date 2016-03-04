@extends('layouts.app')

@section('content')
    
    <section id="content">

      <div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-trophy"></i> Aktionen</h1>
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
    <div class="large-4 medium-6 small-12 columns">
      <h4>Neue Aktionen</h4>
      <div class="callout">keine neuen Aktionen</div>

      <h4>Vergangene Aktionen</h4>
      <div class="callout"></div>
    </div>
    <div class="large-8 medium-6 small-12 columns">
      <div class="row">
        <div class="small-12 columns">
          <h4>Bereits registriert</h4>
        </div> 
          <div class="small-12 columns">

      @if((time() - $user->birthday) >= 567648000)
              <ul class="accordion" data-accordion data-allow-all-closed="true">
        @foreach($raffles as $raffle)
                <li class="accordion-item" data-accordion-item data-accordion>
                  <a href="#" class="accordion-title">{{ $raffle->title }}</a>
                  <div class="accordion-content" data-tab-content>
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
                </li>
        @endforeach
        </ul>
      @else
        <div class="large-12 columns">
          <div class="callout alert">Gewinnspiele sind nur für Mitglieder über 18 Jahren zugänglich.</div>
        </div>
      @endif

    </div>
  </div>

    </section>
    
@endsection