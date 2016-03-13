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
              <p>{!! session('msg') !!}</p>
            </div>
          </div>
        </div>
      @endif

  <div class="row">
    <div class="large-4 medium-6 small-12 columns">
      <h4>Neue Aktionen</h4>
      @if(count($raffles_2) > 0)
        <ul class="accordion" data-accordion data-allow-all-closed="true">
        @foreach($raffles_2 as $raffle)
          <li class="accordion-item" data-accordion-item data-accordion>
            <a href="#" class="accordion-title">{{ $raffle->title }}</a>
              <div class="accordion-content" data-tab-content>
                @if(($raffle->legalAgeReq == 1) && (time() - $user->birthday) < 567648000)

          <div class="callout alert">Dieses Gewinnspiel ist nur für Mitglieder ab 18 zugänglich.</div>
        @else

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

                    <p>{!! $raffle->body !!}</p>

                    @if(count($raffle->codes) != 0)
                      <div class="callout">
                        <label>
                          Hast du einen Code?
                          {!! Form::text('code', null, ['placeholder' => 'Code', 'maxlength' => '10']) !!}
                        </label>
                      </div>
                    @endif

                      <div class="pull-right">Läuft noch bis {{ date(trans('global.dateformat'), $raffle->end) }}</div>
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
                      @endif
                  </div>
                </li>

        @endforeach
        </ul>
      @else
        <div class="callout">keine neuen Aktionen</div>
      @endif
      <h4>Vergangene Aktionen</h4>
      @if(count($raffles_3) > 0)
        <ul class="accordion" data-accordion data-allow-all-closed="true">
        @foreach($raffles_3 as $raffle)
          <li class="accordion-item" data-accordion-item data-accordion>
            <a href="#" class="accordion-title">{{ $raffle->title }}</a>
            <div class="accordion-content" data-tab-content>
              <p>{!! $raffle->body !!}</p>

              <p><em>Abgelaufen seit {{ date(trans('global.dateformat'), $raffle->end) }}</em></p>
            </div>
          </li>
        @endforeach
        </ul>
      @else
        <div class="callout">keine vergangenen Aktionen</div>
      @endif
    </div>
    <div class="large-8 medium-6 small-12 columns">
      <div class="row">
        <div class="small-12 columns">
          <h4>Bereits registriert</h4>
        </div> 
          <div class="small-12 columns">

        @if(count($raffles_1) > 0)
              <ul class="accordion" data-accordion data-allow-all-closed="true">
          @foreach($raffles_1 as $raffle)
                <li class="accordion-item" data-accordion-item data-accordion>
                  <a href="#" class="accordion-title">{{ $raffle->title }}</a>
                  <div class="accordion-content" data-tab-content>
                    <p>{!! $raffle->body !!}</p>

                    @if($raffle->pivot->confirmed == 1)
                      <div class="callout">
                        Du wurdest für diese Aktion bestätigt.
                      </div>
                    @elseif(count($raffle->codes) != 0)
                      <div class="callout">
                        {!! Form::open(['url' => 'dashboard/confirm', 'method' => 'post', 'files' => true]) !!}
                        {!! Form::hidden('id', $raffle->id, []) !!}
                        <label>
                          Hast du einen Code?
                          {!! Form::text('code', null, ['placeholder' => 'Code', 'maxlength' => '10']) !!}
                        </label>
                        <button class="alert button" role="submit">
                        Code senden
                        </button>
                        {!! Form::close() !!}
                      </div>
                    @endif

                    <p><em>Läuft noch bis {{ date(trans('global.dateformat'), $raffle->end) }}</em></p>
                  </div>
                </li>
          @endforeach
        </ul>
        @else
          <div class="callout">Du bist momentan für keine Aktion registriert.</div>
        @endif

    </div>
  </div>

    </section>
    
@endsection