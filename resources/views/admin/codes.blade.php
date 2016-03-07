@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-tag"></i> Codes für Aktionen</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="orderby">Aktion</th>
                <th>Anzahl Codes</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($codes as $code) --}}
                 <tr>
                    <td>VIP Tickets Freitag</td>
                    <td>320</td>
                    <td>
                      <a href="{{-- url('admin/codes/'. $raffle->id ) --}}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Codes zu Aktion anzeigen"><i class="fa fa-search"></i></a>
                      <a 
                        href="{{-- url('admin/codes/'. $raffle->id . '/create' ) --}}"
                        class="tiny button success" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Codes hinzufügen"
                      ><i class="fa fa-plus"></i></a>
                    </td>
                  </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <script>
      $(document).ready(function() {
          // Functionality for deleting raffles:
          $('#table').on('click', '.deleteRaffleButton', function() {
            deleteRaffleModal(this);
          });
      } );

      function deleteRaffleModal(obj){
        var raffleId = $(obj).attr('raffleId');
        $('#raffleId').val(raffleId);
      }
    </script>
    
@endsection