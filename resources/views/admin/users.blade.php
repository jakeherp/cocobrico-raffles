@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <a href="{{ url('admin/users/newsletter') }}" class="pull-right success button"><i class="fa fa-newspaper-o"></i> Newsletter-Abonnenten exportieren</a>
        <h1><i class="fa fa-user"></i> Mitglieder</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th class="no-sort"></th>
                <th>Name</th>
                <th>M/W</th>
                <th class="orderby">Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th>Aktionen</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                @if($member->active == 0)
                  <tr class="cancelled">
                @else
                 <tr>
                @endif
                    <td>
                      @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                      <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                      @else
                        Kein Foto
                      @endif
                    </td>
                    <td>
                      @if( count($member->messages) > 0 )
                        <a href="{{ URL('admin/messages/'.$member->id) }}" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Nachrichtenverlauf"><i class="fa fa-envelope"></i></a>
                      @endif
                      @if( count($member->remarks) > 0 )
                        <a href="{{ URL('admin/users/'.$member->id.'/remarks') }}" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Kommentare"><span style="color: green">R</span></a>
                      @endif
                    </td>
                    <td>
                      @if($member->firstname == '' && $member->lastname == '')
                        {{ $member->email }}
                      @else
                        {{ $member->firstname }} {{ $member->lastname }}
                      @endif
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
                    <td><span class="has-tooltip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="
                      @foreach($member->raffles AS $raffle)
                        {{ $raffle->title }} 
                      @endforeach
                    ">
                      {{ count($member->raffles) }}
                    </span></td>
                    <td>
                      <a href="{{ URL('admin/users/'.$member->id) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      <a 
                        href="{{ url('admin/users/'. $member->id . '/edit' ) }}"
                        class="tiny button warning" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                      <a href="{{ URL('admin/users/'.$member->id.'/remarks') }}" class="tiny button success" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Kommentare"><i class="fa fa-comment"></i></a>
                      <a 
                        class="tiny button alert deleteUserButton" 
                        userId="{{ $member->id }}" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Löschen" 
                        data-open="deleteUserModal" 
                      ><i class="fa fa-trash"></i></a>
                      @if($member->active == 1)
                        <a 
                          class="tiny button alert blockUserButton" 
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
                          class="tiny button alert blockUserButton" 
                          userId="{{ $member->id }}" 
                          blockState=0 
                          data-tooltip aria-haspopup="true" 
                          data-disable-hover='false' 
                          tabindex=1 
                          title="Entsperren" 
                          data-open="blockUserModal" 
                        ><i class="fa fa-ban"></i></a>
                      @endif
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- Modal for deleting users -->
    <div class="reveal" id="deleteUserModal" data-reveal>
      <h3>Benutzer löschen</h3>
      <div class="callout alert">Wollen Sie den Benutzer wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/users/delete', 'method' => 'post']) !!}
        <input type="hidden" id="userId" name="userId" value="">
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
        <input type="hidden" id="userId2" name="user_id" value="">
        <button id="blockUserButton" class="alert button">Bestätigen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting user:
          $('#table').on('click', '.deleteUserButton', function() {
            deleteUserModal(this);
          });

          // Functionality for blocking user:
          $('#table').on('click', '.blockUserButton', function() {
            blockUserModal(this);
          });
      });

      function deleteUserModal(obj){
        var userId = $(obj).attr('userId');
        $('#userId').val(userId);
      }

      function blockUserModal(obj){
        var userId = $(obj).attr('userId');
        var blockState = $(obj).attr('blockState');
        if(blockState == 1){
          $('#blockUserHeadline').html('Benutzer sperren');
          $('#blockUserText').html('Wollen Sie den Benutzer wirklich sperren?');
        }
        else{
          $('#blockUserHeadline').html('Benutzer entsperren');
          $('#blockUserText').html('Wollen Sie den Benutzer wirklich entsperren?');
        }
        $('#userId2').val(userId);
      }
    </script>
    
@endsection