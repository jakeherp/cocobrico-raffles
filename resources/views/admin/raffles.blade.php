@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
      	<a href="{{ url('admin/raffles/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Aktion hinzufügen</a>
        <h1><i class="fa fa-trophy"></i> Aktionen</h1>
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
                <th>Name</th>
                <th class="orderby">Startdatum</th>
                <th>Enddatum</th>
                <th>Eventdatum</th>
                <th>Teilnehmer</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($raffles as $raffle)
                @if($raffle->expired())
                  <tr class="has-error">
                @elseif($raffle->start <= time())
                  <tr class="has-success">
                @else
                  <tr>
                @endif
                    <td>
                      @if($raffle->endState == 1)
                        @if( ($raffle->end - time()) < (2 * 24 * 3600) )
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 48h" ><div class="ampel red"></div></a>
                        @elseif( ($raffle->end - time()) < (5 * 24 * 3600) )
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 5d" ><div class="ampel yellow"></div></a>
                        @else
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< {{ ceil(($raffle->end - time())/(3600*24)) }}d" ><div class="ampel green"></div></a>
                        @endif
                      @elseif($raffle->hasEventDate == 1)
                        @if( ($raffle->eventDate - time()) < (2 * 24 * 3600) )
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 48h" ><div class="ampel red"></div></a>
                        @elseif( ($raffle->eventDate - time()) < (5 * 24 * 3600) )
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 5d" ><div class="ampel yellow"></div></a>
                        @else
                          <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< {{ ceil(($raffle->end - time())/(3600*24)) }}d" ><div class="ampel green"></div></a>
                        @endif
                      @else
                        <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Nicht auslaufend" ><div class="ampel green"></div></a>
                      @endif
                    </td>
                    <td>{{ $raffle->title }}</td>
                    <td>{{ date(trans('global.datetimeformat'), $raffle->start) }}</td>
                    @if($raffle->endState == 0)
                      <td>Unbegrenzt</td>
                    @elseif($raffle->end <= $raffle->start)
                      <td class="has-alert">{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
                    @elseif(time() >= $raffle->end)
                      <td class="has-success">{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
                    @else
                      <td>{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
                    @endif
                    @if($raffle->eventDate == 0)
                      <td>keines</td>
                    @else
                      <td>{{ date(trans('global.dateformat'), $raffle->eventDate) }}</td>
                    @endif
                      @if($raffle->maxpState == 0)
                        <td> {{ count($raffle->users) }} </td>
                      @elseif(count($raffle->users) >= $raffle->maxp)
                        <td class="has-success"> {{ count($raffle->users) }} / {{ $raffle->maxp }}</td>
                      @else
                        <td> {{ count($raffle->users) }} / {{ $raffle->maxp }}</td>
                      @endif
                    </td>
                    <td>
                      <a href="{{ url('admin/raffles/'. $raffle->id ) }}" class="tiny button" aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Teilnehmer anzeigen"><i class="fa fa-search"></i></a>
                      <a 
                        href="{{ url('admin/raffles/'. $raffle->id . '/edit' ) }}"
                        class="tiny button warning editRaffleButton" 
                        aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                      <a href="{{ url('admin/raffles/'. $raffle->id .'/emails' ) }}" class="tiny button success" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Emails zuordnen"><i class="fa fa-envelope"></i></a>
                      <a 
                        class="tiny button alert deleteRaffleButton" 
                        raffleId="{{ $raffle->id }}" 
                        aria-haspopup="true" 
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