@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        <a href="{{ url('admin/codes/'.$raffle->id.'/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Codes hinzufügen</a>
        <a id="deactivateSelectedCodes" class="pull-right alert button" title="Markierte Codes annullieren" disabled="true"><i class="fa fa-ban"></i></a>
        @if(count($raffle->codes) > 0)
          <a 
            id="preparePrintButton" 
            class="pull-right primary button" 
            title="Druckansicht" 
            data-open="preparePrintModal"><i class="fa fa-print"></i></a>
        @else
          <a class="pull-right primary button" disabled><i class="fa fa-print"></i></a>
        @endif
        <h1><i class="fa fa-tag"></i> Codes für {{ $raffle->title }}</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
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
              @foreach($raffle->codes as $code)
                @if($code->active == 0)
                 <tr class="cancelled">
                @else
                 <tr codeid="{{ $code->id }}">
                @endif
                    <td>{{ $code->code }}</td>
                    <td>{{ $code->remark }}</td>
                    <td>{{ date(trans('global.dateformat'),$code->endtime) }}</td>
                    <td>
                      @if($code->user == null)
                        Nicht zugewiesen
                      @else
                        <a href="{{ url('admin/users/'. $code->user->id ) }}">{{ $code->user->firstname }} {{ $code->user->lastname }}</a>
                      @endif
                    </td>
                    <td>
                      <button href="{{ url('admin/codes/detail/'. $code->id ) }}" class="tiny button" title="Kundendetails anzeigen" disabled><i class="fa fa-search"></i></button>
                      @if($code->active == 0 || $code->user != null)
                        <a class="tiny button alert" disabled><i class="fa fa-ban"></i></a>
                      @else
                        <a 
                        class="tiny button alert deactivateCodeButton" 
                        codeId="{{ $code->id }}" 
                        title="Annullieren" 
                        data-open="deactivateCodeModal" 
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

    <!-- Modal for deactivating codes -->
    <div class="reveal" id="deactivateCodeModal" data-reveal>
      <h3>Code Annulieren</h3>
      <div class="callout alert">Wollen Sie den Code wirklich annulieren?</div>
      {!! Form::open(['url' => 'admin/codes/deactivate', 'method' => 'post']) !!}
        {!! Form::hidden('_method', 'PUT', []) !!}
        <input type="hidden" id="codeId" name="code_id" value="">
        <button id="deactivateCodeButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Modal for filtering codes -->
    <div class="reveal" id="preparePrintModal" data-reveal>
      <h3>Auswahl der Codes</h3>
      <p>Geben Sie Suchbegriffe, getrennt durch Kommata, ein! Lassen Sie das Suchfeld leer, um alle Codes auszuwählen.</p>
      {!! Form::open(['url' => 'admin/codes/print', 'method' => 'post']) !!}
        <input type="hidden" id="raffleId" name="raffle_id" value="{{ $raffle->id }}">
        <div class="callout">
          <span>Verfügbare Stichworte: </span>
          @foreach($raffle->codes()->groupBy('remark')->get() as $code)
              <label class="success label">{{ $code->remark }}</label>
          @endforeach
        </div>
        <div class="input-group">
          {{ Form::text('remark', null, ['class' => 'input-group-field', 'placeholder' => 'Suchbegriff']) }}
        </div>
        {!! Form::submit('Druckansicht', ['class' => 'button alert']) !!}
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).ready(function() {
          // Functionality for deactivating codes:
          $('#table').on('click', '.deactivateCodeButton', function() {
            deactivateCodeModal(this);
          });

          var table = $('#table').DataTable();

          var selectedLines = 0;
          var codes = [];
       
          $('#table tbody').on( 'click', 'tr', function () {
            if(!$(this).hasClass('selected')){
              $(this).addClass('selected');
              codes.push($(this).attr('codeid'));
              selectedLines++;
            }
            else{
              $(this).removeClass('selected');
              codes.splice(codes.indexOf($(this).attr('codeid')), 1);
              selectedLines--;
            }
            console.log(codes);
            if($('#deactivateSelectedCodes').attr("disabled", true) && selectedLines > 0){
              $('#deactivateSelectedCodes').attr("disabled", false);
            }
            else{
              $('#deactivateSelectedCodes').attr("disabled", true);
            }
          } );
       
          $('#deactivateSelectedCodes').click( function () {
              jQuery.each( codes, function( i, val ) {
                $.ajax({
                  url: 'deactivateAction',
                  type: "post",
                  data: {'_method': 'PUT', 'code_id':val}
                });
              });
              location.reload();
          } );
      } );

      function deactivateCodeModal(obj){
        var codeId = $(obj).attr('codeId');
        $('#codeId').val(codeId);
      }

      function checkForDeactivateButton(){
        return $('.selected').length;
      }

      function refreshDataTable(){

      }
    </script>
    
@endsection