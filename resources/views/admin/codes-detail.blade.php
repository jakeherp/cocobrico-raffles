@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <a href="{{ url('admin/codes/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Codes hinzufügen</a>
        <a href="{{ url('admin/codes/delete') }}" class="pull-right alert button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Codes annullieren"><i class="fa fa-ban"></i></a>
        <a href="{{ url('admin/codes/print') }}" class="pull-right primary button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Druckansicht"><i class="fa fa-print"></i></a>
        <h1><i class="fa fa-tag"></i> Codes</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Code</th>
                <th class="orderby">Bemerkung</th>
                <th>Gültig bis</th>
                <th>Kunde</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($codes as $code) --}}
                 <tr>
                    <td>W39CP0OPZ7</td>
                    <td>VIP Tickets Freitag</td>
                    <td>15.04.2016</td>
                    <td></td>
                    <td>
                      <button href="{{-- url('admin/codes/'. $code->id ) --}}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Kundendetails anzeigen" disabled><i class="fa fa-search"></i></button>
                      <a 
                        href="{{-- url('admin/codes/'. $raffle->id . '/cancel' ) --}}"
                        class="tiny button alert" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Annullieren"
                      ><i class="fa fa-ban"></i></a>
                    </td>
                  </tr>
                 <tr>
                    <td>CE9WLDC921</td>
                    <td>VIP Tickets Samstag</td>
                    <td>16.04.2016</td>
                    <td></td>
                    <td>
                      <a href="{{-- url('admin/codes/'. $code->id ) --}}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Kundendetails anzeigen"><i class="fa fa-search"></i></a>
                      <button 
                        href="{{-- url('admin/codes/'. $raffle->id . '/cancel' ) --}}"
                        class="tiny button alert" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Annullieren"
                        disabled
                      ><i class="fa fa-ban"></i></a>
                    </td>
                  </tr>
              {{-- @endforeach --}}
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

          var table = $('#table').DataTable();
       
          $('#table tbody').on( 'click', 'tr', function () {
              $(this).toggleClass('selected');
          } );
       
          $('#button').click( function () {
              alert( table.rows('.selected').data().length +' Einträge annulliert' );
          } );
      } );

      function deleteRaffleModal(obj){
        var raffleId = $(obj).attr('raffleId');
        $('#raffleId').val(raffleId);
      }
    </script>
    
@endsection