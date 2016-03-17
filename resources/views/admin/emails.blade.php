@extends('layouts.admin')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
      	<a href="{{ url('admin/emails/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Email hinzufügen</a>
        <h1><i class="fa fa-envelope"></i> Emails</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="orderby">Beschreibung</th>
                <th>Anhänge</th>
                <th>Standard</th>
                <th>Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($emails as $email)
                <tr>
                  <td>{{ $email->description }}</td>
                  <td>{{ count($email->confirmations) }}</td>
                	<td>
                   @if($email->standard == 1)
                      <i class="fa fa-check"></i> Standard
                    @else
                      <i class="fa fa-close"></i>
                    @endif 
                  </td>
                	<td>
                    <a href="{{ url('admin/emails/'. $email->id .'/preview' ) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Vorschau"><i class="fa fa-search"></i></a>
                    <a 
                        href="{{ url('admin/emails/'. $email->id . '/edit' ) }}"
                        class="tiny button warning" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                      <a href="{{ url('admin/emails/'. $email->id .'/pdf' ) }}" class="tiny button success" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="PDFs zuordnen"><i class="fa fa-file-pdf-o"></i></a>
                		@if($email->standard == 1)
                			<a class="tiny button alert" disabled="true"><i class="fa fa-trash"></i></a>
                		@else
	                		<a 
	                        class="tiny button alert deleteEmailButton" 
	                        emailId="{{ $email->id }}" 
	                        data-tooltip aria-haspopup="true" 
	                        data-disable-hover='false' 
	                        tabindex=1 
	                        title="Löschen" 
	                        data-open="deleteEmailModal" 
	                      	><i class="fa fa-trash"></i></a>
	                    @endif
                	</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</section>

  <!-- Modal for deleting emails -->
    <div class="reveal" id="deleteEmailModal" data-reveal>
      <h3>Email löschen</h3>
      <div class="callout alert">Wollen Sie die Email wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/emails/delete', 'method' => 'post']) !!}
        <input type="hidden" id="emailId" name="emailId" value="">
        <button id="deleteEmailButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting emails:
          $('#table').on('click', '.deleteEmailButton', function() {
            deleteEmailModal(this);
          });
      });

      function deleteEmailModal(obj){
        var emailId = $(obj).attr('emailId');
        $('#emailId').val(emailId);
      }
    </script>

@endsection