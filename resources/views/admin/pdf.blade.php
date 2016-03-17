@extends('layouts.admin')

@section('content')

<section class="row" id="content">
  	<div class="large-12 column">
      	<a href="{{ url('admin/pdf/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> PDF hinzufügen</a>
        <h1><i class="fa fa-file-pdf-o"></i> PDFs</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Titel</th>
                <th class="orderby">Beschreibung</th>
                <th>Standard</th>
                <th>Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($confirmations as $confirmation)
                <tr>
                	<td>{{ $confirmation->title }}</td>
                  <td>{{ $confirmation->description }}</td>
                	<td>
                    @if($confirmation->standard == 1)
                      <i class="fa fa-check"></i> Standard
                    @else
                      <i class="fa fa-close"></i>
                    @endif
                  </td>
                	<td>
                    <a href="{{ url('admin/pdf/'. $confirmation->id .'/preview' ) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Vorschau"><i class="fa fa-search"></i></a>
                    <a 
                        href="{{ url('admin/pdf/'. $confirmation->id . '/edit' ) }}"
                        class="tiny button warning" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Bearbeiten"
                      ><i class="fa fa-pencil"></i></a>
                		@if($confirmation->standard == 1)
                			<a class="tiny button alert" disabled="true"><i class="fa fa-trash"></i></a>
                		@else
	                		<a 
	                        class="tiny button alert deleteConfirmationButton" 
	                        pdfId="{{ $confirmation->id }}" 
	                        data-tooltip aria-haspopup="true" 
	                        data-disable-hover='false' 
	                        tabindex=1 
	                        title="Löschen" 
	                        data-open="deleteConfirmationModal" 
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

  <!-- Modal for deleting pdfs -->
    <div class="reveal" id="deleteConfirmationModal" data-reveal>
      <h3>PDF löschen</h3>
      <div class="callout alert">Wollen Sie die PDF wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/pdf/delete', 'method' => 'post']) !!}
        <input type="hidden" id="pdfId" name="pdfId" value="">
        <button id="deleteConfirmationButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting pdfs:
          $('#table').on('click', '.deleteConfirmationButton', function() {
            deleteConfirmationModal(this);
          });
      });

      function deleteConfirmationModal(obj){
        var pdfId = $(obj).attr('pdfId');
        $('#pdfId').val(pdfId);
      }
    </script>

@endsection