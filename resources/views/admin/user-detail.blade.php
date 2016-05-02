@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
              @if($member->active == 1)
                <a 
                  class="button small alert blockUserButton pull-right" 
                  blockState=1 
                  aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Sperren" 
                  data-open="blockUserModal" 
                ><i class="fa fa-ban"></i></a>
              @else
                <a 
                  class="button small alert blockUserButton pull-right" 
                  blockState=0 
                  aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Entsperren" 
                  data-open="blockUserModal" 
                ><i class="fa fa-ban"></i></a>
              @endif
              <a 
                class="button small alert deleteUserButton pull-right" 
                aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Löschen" 
                data-open="deleteUserModal" 
              ><i class="fa fa-trash"></i></a>
              @if($member->hasPermission('change_picture') || $member->hasPermission('change_details'))
                <a 
                  class="button small warning deleteFlagButton pull-right" 
                  aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Berechtigung zur Datenänderung" 
                  data-open="deleteFlagModal" 
                ><i class="fa fa-question"></i></a>
              @else
                <a 
                  class="button small success checkDataButton pull-right" 
                  aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Daten überprüfen" 
                  data-open="checkDataModal" 
                ><i class="fa fa-question"></i></a>
              @endif
              <a
                class="button small primary"
                style="float:right;"
                aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Protokoll"
                href="{{ URL('admin/users/'.$member->id.'/remarks') }}"
                ><i class="fa fa-comment"></i></a>
              <a
                class="button small secondary"
                style="float:right;"
                aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Nachrichten"
                href="{{ URL('admin/messages/'.$member->id) }}"
                ><i class="fa fa-envelope"></i></a>
              <a
                class="button small warning"
                style="float:right;"
                aria-haspopup="true" 
                data-disable-hover='false' 
                tabindex=1 
                title="Bearbeiten"
                href="{{ URL('admin/users/'. $member->id . '/edit' ) }}"
                ><i class="fa fa-pencil"></i></a>

        <h4>
        @if($member->firstname == '')
          {{ $member->email }}
        @else
          {{ $member->firstname }} {{ $member->lastname }}
        @endif
        </h4>
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
                  <td>{{ date(trans('global.dateformat'),strtotime($member->registered_at)) }}</td>
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
                  <td>{{ $member->remark }}</td>
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
                      {{ date(trans('global.datetimeformat'),$raffle->users()->find($member->id)->pivot->participated_at) }}
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
                      <a href="{{ URL('admin/raffles/'.$raffle->id) }}" class="small button" aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      @if($raffle->pivot->confirmed == 1)
                        <a data-open="resendModal" raffleId="{{ $raffle->id }}" class="small success button resendModalButton" aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Erneut senden"><i class="fa fa-envelope"></i></a>
                      @else
                        <a data-open="userWinModal" raffleId="{{ $raffle->id }}" class="small success button confirmUserButton" aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Bestätigen"><i class="fa fa-trophy"></i></a>
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

    <!-- Modal for deleting users -->
    <div class="reveal" id="deleteUserModal" data-reveal>
      <h3>Benutzer löschen</h3>
      <div class="callout alert">Wollen Sie den Benutzer wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/users/delete', 'method' => 'post']) !!}
        <input type="hidden" id="userId" name="userId" value="{{ $member->id }}">
        <button id="deleteUserButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Modal for blocking users -->
    <div class="reveal" id="blockUserModal" data-reveal>
      <h3 id="blockUserHeadline">Benutzer sperren</h3>
      <div class="callout alert" id="blockUserText">Wollen Sie den Benutzer wirklich sperren?</div>
      {!! Form::open(['url' => 'admin/users/block', 'method' => 'post']) !!}
        <input type="hidden" id="userId2" name="user_id" value="{{ $member->id }}">
        <button id="blockUserButton" class="alert button">Bestätigen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Modal for checking data of user -->
    <div class="reveal" id="checkDataModal" data-reveal>
      <h3>Daten überprüfen lassen</h3>
      <div class="callout alert">Senden Sie dem Benutzer eine Nachricht mit genaueren Informationen!</div>
      {!! Form::open(['url' => 'admin/users/check', 'method' => 'post']) !!}
        <input type="hidden" name="user_id" value="{{ $member->id }}">
        <input type="text" name="message" value="" placeholder="Nachricht">
        <label><div class="input-group">
          {!! Form::checkbox('allowDetailChange', '1', true) !!} Dem Benutzer erlauben seine Kontaktdaten und sein Geburtsdatum jederzeit ändern zu können.
        </div></label>
        <label><div class="input-group">
          {!! Form::checkbox('allowPictureChange', '1', false) !!} Dem Benutzer erlauben sein Profilfoto jederzeit ändern zu können.
        </div></label>
        <button id="checkDataButton" class="alert button">Senden</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Modal for deleting flags -->
    <div class="reveal" id="deleteFlagModal" data-reveal>
      <h3>Erlaubnis zur Datenänderung</h3>
      <div class="callout alert">Wollen Sie dem User die Erlaubnis zur Daten-/Profilbildänderung entziehen?</div>
      {!! Form::open(['url' => 'admin/users/check', 'method' => 'post']) !!}
        <input type="hidden" name="user_id" value="{{ $member->id }}">
        <input type="hidden" name="delete" value="1">
        <button id="blockUserButton" class="alert button">Bestätigen</button>
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

          // Functionality for deleting user:
          $('#table').on('click', '.deleteUserButton', function() {
            deleteUserModal(this);
          });

          // Functionality for blocking user:
          $('#table').on('click', '.blockUserButton', function() {
            blockUserModal(this);
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


      function blockUserModal(obj){
        var blockState = $(obj).attr('blockState');
        if(blockState == 1){
          $('#blockUserHeadline').html('Benutzer sperren');
          $('#blockUserText').html('Wollen Sie den Benutzer wirklich sperren?');
        }
        else{
          $('#blockUserHeadline').html('Benutzer entsperren');
          $('#blockUserText').html('Wollen Sie den Benutzer wirklich entsperren?');
        }
      }
    </script>
	
@endsection