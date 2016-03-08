@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
        <h1>{{ $raffle->title }}</h1>
        @if($raffle->endState == 1 && $raffle->end < $raffle->start)
          <div class="callout alert">
            <p>Fehler: Die Endzeit liegt vor der Startzeit.</p>
          </div>
        @elseif($raffle->endState == 1 && time() >= $raffle->end)
          <div class="callout alert">
            <p>Die Akion ist beendet, da das Zeitlimit überschritten wurde.</p>
          </div>
        @endif
        @if($raffle->maxpState == 1 && count($members) >= $raffle->maxp)
          <div class="callout alert">
          <p>Die Akion ist beendet, da das Teilnehmerlimit erreicht wurde.</p>
          </div>
        @endif
        <div class="callout">
          <p><strong>Start:</strong> {{ date(trans('global.datetimeformat'), $raffle->start) }}, 
          <strong>Ende:</strong> 
            @if($raffle->endState == 0)
              Unbegrenzt
            @else
              {{ date(trans('global.datetimeformat'), $raffle->end) }}
            @endif
          </p>
          <p>{!! $raffle->body !!}</p>
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
          <a class="button secondary" href="{{ URL('admin/raffles/'.$raffle->id.'/pdf') }}">PDF Vorschau</a>
        </div>
        @if($raffle->sendPdf == 1)
          <div class="callout">
            <?php
              $file = $raffle->files()->where('slug','raffle_img')->first();
            ?>

            <p>Aktionsgrafik:</p>
            @if($file != null)
              <img src="{{ URL::asset($file->path) }}" style="width:700px;height:400px;">
            @else
              Keine Grafik vorhanden
            @endif
          </div>
        @endif
      </div>

        <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Teilnehmer <span class="label">{{ count($members) }}</span></h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th>Name</th>
                <th>Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th class="orderby">Teilnahme</th>
                <th>Bestätigt</th>
                <th>Code</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                 <tr>
                    <td>
                      @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                      <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                      @else
                        Kein Foto
                      @endif
                    </td>
                    <td>
                      {{ $member->firstname }} {{ $member->lastname }}
                    </td>
                    <td>
                      {{ floor((time() - $member->birthday) / 31556926) }} Jahre - {{ date(trans('global.dateformat'),$member->birthday) }}</td>
                    <td>
                      {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}
                    </td>
                    <td>
                      {{ date(trans('global.datetimeformat'),strtotime($raffle->users()->find($member->id)->pivot->created_at)) }}
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      <a href="{{ URL('admin/users/'.$member->id) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      <a data-open="userWinModal" class="tiny success button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Bestätigen"><i class="fa fa-trophy"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- Modal for deleting raffles -->
    <div class="reveal" id="userWinModal" data-reveal>
      <h3>Firstname Lastname für Title bestätigen?</h3>
      <div class="callout alert">Wollen Sie Firstname Lastname wirklich bestätigen?</div>
        <input type="hidden" id="raffleId" name="raffleId" value="">
        <button id="userWinButton" class="success button">Bestätigen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

@endsection