@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
      	<a href="{{ url('admin/raffles/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Aktion hinzufügen</a>
        <h1><i class="fa fa-trophy"></i> Aktionen</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Name</th>
                <th class="orderby">Startdatum</th>
                <th>Enddatum</th>
                <th>Teilnehmer</th>
                <th>Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($raffles as $raffle)
                 <tr>
                    <td>{{ $raffle->title }}</td>
                    <td>{{ date(trans('global.datetimeformat'), $raffle->start) }}</td>
                    <td>{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
                    <td>{{ count($raffle->users) }}</td>
                    <td>
                      <a href="{{ url('admin/raffles/'. $raffle->id ) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Teilnehmer anzeigen"><i class="fa fa-search"></i></a>
                      <a 
                        href="{{ url('admin/raffles/'. $raffle->id . '/edit' ) }}"
                        class="tiny button warning editRaffleButton" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                      <a 
                        class="tiny button alert deleteRaffleButton" 
                        raffleId="{{ $raffle->id }}" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Löschen" 
                        data-open="deleteRaffleModal" 
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
    <div class="reveal" id="deleteRaffleModal" data-reveal>
      <h3>Aktion löschen</h3>
      <div class="callout alert">Wollen Sie die Aktion wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/raffles/delete', 'method' => 'post']) !!}
        <input type="hidden" id="raffleId" name="raffleId" value="">
        <button id="deleteRaffleButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting raffles:
          $('#table').on('click', '.deleteRaffleButton', function() {
            deleteRaffleModal(this);
          });
      });

      function deleteRaffleModal(obj){
        var raffleId = $(obj).attr('raffleId');
        $('#raffleId').val(raffleId);
      }
    </script>
    
@endsection