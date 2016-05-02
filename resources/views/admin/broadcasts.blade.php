@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <a href="{{ url('admin/broadcasts/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Broadcast hinzufügen</a>
        <h1><i class="fa fa-microphone"></i> Broadcasts</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="orderby">End-Datum</th>
                <th>Titel</th>
                <th>Text</th>
                <th>Deaktiviert</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($broadcasts as $broadcast)
                 <tr>
                    <td>{{ date(trans('global.datetimeformat'),$broadcast->expiryDate) }}</td>
                    <td>{{ $broadcast->headline }}</td>
                    <td>{{ substr($broadcast->text, 0, 15) }}...</td>
                    <td>{{ count($broadcast->users) }}</td>
                    <td>
                      <a 
                        href="{{ url('admin/broadcasts/'. $broadcast->id . '/edit' ) }}"
                        class="tiny button warning" 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                      <a 
                        class="tiny button alert deleteBroadcastButton" 
                        broadcastId="{{ $broadcast->id }}" 
                        title="Löschen" 
                        data-open="deleteBroadcastModal" 
                      ><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- Modal for deleting broadcasts -->
    <div class="reveal" id="deleteBroadcastModal" data-reveal>
      <h3>Broadcast löschen</h3>
      <div class="callout alert">Wollen Sie den Broadcast wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/broadcasts/delete', 'method' => 'post']) !!}
        <input type="hidden" id="broadcastId" name="broadcast_id" value="">
        <button id="deleteBroadcastButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting raffles:
          $('#table').on('click', '.deleteBroadcastButton', function() {
            deleteBroadcastModal(this);
          });
      });

      function deleteBroadcastModal(obj){
        var broadcastId = $(obj).attr('broadcastId');
        $('#broadcastId').val(broadcastId);
      }
    </script>
    
@endsection