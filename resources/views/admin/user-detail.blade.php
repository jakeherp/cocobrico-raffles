@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
              @if($member->active == 1)
                <a 
                  class="button small alert blockUserButton pull-right" 
                  userId="{{ $member->id }}" 
                  blockState=1 
                  data-tooltip aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Sperren" 
                  data-open="blockUserModal" 
                ><i class="fa fa-ban"></i></a>
              @else
                <a 
                  class="button small alert blockUserButton pull-right" 
                  userId="{{ $member->id }}" 
                  blockState=0 
                  data-tooltip aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Entsperren" 
                  data-open="blockUserModal" 
                ><i class="fa fa-ban"></i></a>
              @endif
              <a 
                class="button small alert deleteUserButton pull-right" 
                userId="{{ $member->id }}" 
                data-tooltip aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Löschen" 
                data-open="deleteUserModal" 
              ><i class="fa fa-trash"></i></a>
              <a
                class="button small primary"
                style="float:right;"
                data-tooltip aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Protokoll"
                href="{{ URL('admin/users/'.$member->id.'/remarks') }}"
                ><i class="fa fa-comment"></i></a>
              <a
                class="button small secondary"
                style="float:right;"
                data-tooltip aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Nachrichten"
                href="{{ URL('admin/messages/'.$member->id) }}"
                ><i class="fa fa-envelope"></i></a>
              <a
                class="button small warning"
                style="float:right;"
                data-tooltip aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Bearbeiten"
                href="{{ URL('admin/users/'. $member->id . '/edit' ) }}"
                ><i class="fa fa-pencil"></i></a>

        <h4>{{ $member->firstname }} {{ $member->lastname }}</h4>
         @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{!! session('msg') !!}</p>
          </div>
        @endif
        <div class="callout">
          <div class="row">
            <div class="large-3 medium-3 small-12 columns">
              @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                  <a href="{{ URL::asset($file->path) }}" target="_blank"><img src="{{ URL::asset($file->path) }}" style="max-height: 200px; max-width: 200px;"></a>
              @endif
            </div>
            <div class="large-7 medium-5 small-12 columns">
              <table>
                <tr>
                  <td><strong>Mitglied seit:</strong></td>
                  <td>{{ date(trans('global.dateformat'),strtotime($member->created_at)) }}</td>
                </tr>
                <tr>
                  <td><strong>Geburtsdatum:</strong></td>
                  <td>{{ date(trans('global.dateformat'),$member->birthday) }} / @if($member->gender == 0)
                        M
                      @elseif($member->gender == 1)
                        W
                      @endif</td>
                </tr>
                @if($member->address != null)
                <tr>
                  <td><strong>Anschrift:</strong></td>
                  <td>{{ $member->address->address1 }} {{ $member->address->address2 }}</td>
                </tr>
                <tr>
                  <td><strong>PLZ / Ort:</strong></td>
                  <td>{{ $member->address->zipcode }} {{ $member->address->city }}</td>
                </tr>
                <tr>
                  <td><strong>Land:</strong></td>
                  <td>{{ $member->address->country->name }}</td>
                </tr>
                <tr>
                  <td><strong>Telefon:</strong></td>
                  <td><a href="tel:{{ $member->address->phone }}">{{ $member->address->phone }}</a></td>
                </tr>
                @endif
                <tr>
                  <td><strong>Email:</strong></td>
                  <td><a href="mailto:{{ $member->email }}"> {{ $member->email }}</a></td>
                </tr>
                <tr>
                  <td><strong>Kommentar:</strong></td>
                  <td></td>
              </table>
            </div>
            <div class="large-2 medium-3 small-12 columns">

            </div>
          </div>
        </div>
      </div>
      <div class="large-12 column">
        <h4>Der User hat an folgenden Aktionen teilgenommen:</h4>

        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Aktion</th>
                <th class="orderby">Teilnahme</th>
                <th>Bestätigt</th>
                <th>Code</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($member->raffles as $raffle)
                 <tr>
                    <td>
                      {{ $raffle->title }}
                    </td>
                    <td>
                      {{ date(trans('global.datetimeformat'),strtotime($raffle->users()->find($member->id)->pivot->created_at)) }}
                    </td>
                    <td>
                      @if($raffle->pivot->confirmed == 1)
                        <i class="fa fa-check"></i>
                      @endif
                    </td>

                    <td>
                      @if($raffle->pivot->code_id != 0)
                        {{ $raffle->codes()->where('id',$raffle->pivot->code_id)->first()->code }}
                      @endif
                    </td>
                    <td>
                      <a href="{{ URL('admin/raffles/'.$raffle->id) }}" class="small button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      @if($raffle->pivot->confirmed == 1)
                        <a data-open="resendModal" raffleId="{{ $raffle->id }}" class="small success button resendModalButton" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Erneut senden"><i class="fa fa-envelope"></i></a>
                      @else
                        <a data-open="userWinModal" raffleId="{{ $raffle->id }}" class="small success button confirmUserButton" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Bestätigen"><i class="fa fa-trophy"></i></a>
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
      <h3>Bestätigung</h3>
      <div class="callout alert">Soll der User wirklich bestätigt werden?</div>
      {!! Form::open(['url' => 'admin/raffles/confirm', 'method' => 'post']) !!}
        {!! Form::hidden('_method', 'PUT', []) !!}
        <input type="hidden" name="user_id" value="{{ $member->id }}">
        <input type="hidden" id="raffleId" name="raffle_id" value="">
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
        <input type="hidden" name="user_id" value="{{ $member->id }}">
        <input type="hidden" id="raffleId2" name="raffle_id" value="">
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
        var raffleId = $(obj).attr('raffleId');
        $('#raffleId').val(raffleId);
      }

      function resendModal(obj){
        var raffleId = $(obj).attr('raffleId');
        $('#raffleId2').val(raffleId);
      }
    </script>
	
@endsection