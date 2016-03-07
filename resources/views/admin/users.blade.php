@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Mitglieder</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th>Name</th>
                <th class="orderby">Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th>Aktionsteilnahmen</th>
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
                        class="tiny button alert deleteUserButton" 
                        userId="{{ $member->id }}" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Löschen" 
                        data-open="deleteUserModal" 
                      ><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- Modal for deleting raffles -->
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

    <script>
      $(document).ready(function() {
          // Functionality for deleting user:
          $('#table').on('click', '.deleteUserButton', function() {
            deleteUserModal(this);
          });
      });

      function deleteUserModal(obj){
        var userId = $(obj).attr('userId');
        $('#userId').val(userId);
      }
    </script>
    
@endsection