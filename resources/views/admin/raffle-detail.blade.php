@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
        <h1>{{ $raffle->title }}</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{!! session('msg') !!}</p>
          </div>
        @endif
        @if($raffle->endState == 1 && $raffle->end < $raffle->start)
          <div class="callout alert">
            <p>Fehler: Die Endzeit liegt vor der Startzeit.</p>
          </div>
        @elseif($raffle->endState == 1 && time() >= $raffle->end)
          <div class="callout alert">
            <p>Die Akion ist beendet, da das Zeitlimit überschritten wurde.</p>
          </div>
        @elseif($raffle->hasEventDate == 1 && time() >= $raffle->eventDate)
          <div class="callout alert">
            <p>Die Akion ist beendet, da das Event-Datum überschritten wurde.</p>
          </div>
        @endif
        @if($raffle->maxpState == 1 && count($members) >= $raffle->maxp)
          <div class="callout alert">
          <p>Die Aktion ist beendet, da das Teilnehmerlimit erreicht wurde.</p>
          </div>
        @endif
        <div class="callout">
          <p><strong>Start:</strong> {{ date(trans('global.datetimeformat'), $raffle->start) }}<br>
          <strong>Ende:</strong> 
            @if($raffle->endState == 0)
              Unbegrenzt
            @else
              {{ date(trans('global.datetimeformat'), $raffle->end) }}
            @endif
          <br>
          @if($raffle->hasEventDate == 1)
          <strong>Event-Datum:</strong> {{ date(trans('global.datetimeformat'), $raffle->eventDate) }}
          @endif
          </p>
          <p>{!! $raffle->body !!}</p>

          @if($raffle->legalAgeReq == 1)
            <p>Teilnehmer müssen mindestens 18 Jahre alt sein.</p>
          @endif
          @if($raffle->imageReq == 1)
            <p>Teilnehmer müssen ein Profilbild besitzen.</p>
          @endif
          @if($raffle->instWin == 1)
            <p>Alle Teilnehmer werden automatisch bestätigt.</p>
          @endif
          
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
          <a class="button secondary" href="{{ URL('admin/raffles/'.$raffle->id.'/pdf') }}">PDF Vorschau</a>
        </div>
        <div class="callout">
          <?php
            $file = $raffle->files()->where('slug','raffle_img')->first();
          ?>

          <p>Aktionsgrafik:</p>
          @if($file != null)
            <img src="{{ URL::asset($file->path) }}" style="max-width:100%;height:auto;">
          @else
            Keine Grafik vorhanden
          @endif
        </div>
      </div>

        <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Teilnehmer <span class="label">{{ count($members) }}</span></h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th>Name</th>
                <th>Geschlecht</th>
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
                      @if($member->gender == 0)
                        M
                      @elseif($member->gender == 1)
                        W
                      @endif
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
                      @if($member->pivot->confirmed == 1)
                        <i class="fa fa-check"></i>
                      @endif
                    </td>
                    <td>
                      @if($member->pivot->code_id != 0)
                        {{ $raffle->codes()->where('id',$member->pivot->code_id)->first()->code }}
                      @endif
                    </td>
                    <td>
                      <a href="{{ URL('admin/users/'.$member->id) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      @if($member->pivot->confirmed == 1)
                        <a data-open="resendModal" userId="{{ $member->id }}" class="tiny success button resendModalButton" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Erneut senden"><i class="fa fa-envelope"></i></a>
                      @else
                        <a data-open="userWinModal" userId="{{ $member->id }}" class="tiny success button confirmUserButton" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Bestätigen"><i class="fa fa-trophy"></i></a>
                      @endif
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- Modal for confirm users -->
    <div class="reveal" id="userWinModal" data-reveal>
      <h3 id="UserWinHeadline">Bestätigung</h3>
      <div class="callout alert" id="UserWinText">Soll der User wirklich bestätigt werden?</div>
      {!! Form::open(['url' => 'admin/raffles/confirm', 'method' => 'post']) !!}
        {!! Form::hidden('_method', 'PUT', []) !!}
        <input type="hidden" id="userId" name="user_id" value="">
        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
        <button id="userWinButton" class="success button">Bestätigen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
        <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Modal for resend confirmation pdf -->
    <div class="reveal" id="resendModal" data-reveal>
      <h3>Bestätigung</h3>
      <div class="callout alert">Soll die Bestätigungsemail mit PDF nochmal versendet werden?</div>
      {!! Form::open(['url' => 'admin/raffles/resend', 'method' => 'post']) !!}
        <input type="hidden" id="userId2" name="user_id" value="">
        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
        <button id="userWinButton" class="success button">Bestätigen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
        <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
     $(document).ready(function() {
          // Functionality for confirming users:
          $('#table').on('click', '.confirmUserButton', function() {
            userWinModal(this);
          });
          $('#table').on('click', '.resendModalButton', function() {
            resendModal(this);
          });
      } );

      function userWinModal(obj){
        var userId = $(obj).attr('userId');
        $('#userId').val(userId);
      }

      function resendModal(obj){
        var userId = $(obj).attr('userId');
        $('#userId2').val(userId);
      }
    </script>

@endsection