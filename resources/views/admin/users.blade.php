@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Mitglieder</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th>Gewinnspiel Teilnahmen</th>
                <th>Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                 <tr>
                    <td><div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div></td>
                    <td>Max Mustermann</td>
                    <td>01.01.1990 (26 Jahre)</td>
                    <td>01.02.2016</td>
                    <td><span class="has-tooltip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Gewinnspiel 1, Gewinnspiel 2">2</span></td>
                    <td>
                      <a class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
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
      <h3>Cancel order <span class="orderReferenceSpan"></span></h3>
      <div class="callout alert">Wollen Sie das Gewinnspiel wirklich löschen?</div>
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