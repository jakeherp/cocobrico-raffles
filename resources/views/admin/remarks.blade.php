@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-comment"></i> Kommentare </h1>
        @if($member->firstname != '')
          <p>Benutzer: <a href="{{ URL('admin/users/'.$member->id) }}">{{ $member->firstname }} {{$member->lastname}}</a></p>
        @else
          <p>Benutzer: <a href="{{ URL('admin/users/'.$member->id) }}">{{ $member->email }}</a></p>
        @endif

        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif

        @include ('errors.list')

        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="orderby">Erstellt am</th>
                <th>Titel</th>
                <th>Text</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
             @foreach($member->remarks as $remark)
              <tr>
                <td>{{ date(trans('global.datetimeformat'),strtotime($remark->created_at)) }}</td>
                <td>{{ $remark->title }}</td>
                <td>{{ $remark->body }}</td>
                <td>
                <a 
                  href="{{ url('admin/users/remarks/'. $remark->id . '/edit' ) }}"
                  class="tiny button warning" 
                  data-tooltip aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Bearbeiten"
                ><i class="fa fa-pencil"></i></a>
                <a 
                  class="tiny button alert deleteRemarkButton" 
                  remarkId="{{ $remark->id }}" 
                  data-tooltip aria-haspopup="true" 
                  data-disable-hover='false' 
                  tabindex=1 
                  title="Löschen" 
                  data-open="deleteRemarkModal" 
                ><i class="fa fa-trash"></i></a></td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>

        <br>

        <div class="callout">
          {!! Form::open(['url' => 'admin/users/remarks/create', 'method' => 'post']) !!}
            {!! Form::hidden('user_id', $member->id) !!}
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                  {!! Form::text('title', null, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
            </div>
            <div class="input-group">
              <span class="input-group-label"><i class="fa fa-comment"></i></span>
                  {{ Form::textarea('body', null, ['class' => 'input-group-field', 'placeholder' => 'Kommentartext']) }}
            </div>
            <label>
              <div class="input-group">
                <i class="fa fa-eye-slash"></i> 
                {!! Form::checkbox('visible', '1') !!} Der Kommentar ist für den Benutzer sichtbar.
              </div>
            </label>
            {!! Form::submit('Kommentar erstellen', ['class' => 'button alert']) !!}
          {!! Form::close() !!}
        </div>
      </div>

    </section>

    <!-- Modal for deleting remarks -->
    <div class="reveal" id="deleteRemarkModal" data-reveal>
      <h3>Kommentar löschen</h3>
      <div class="callout alert">Wollen Sie den Kommentar wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/users/remarks/delete', 'method' => 'post']) !!}
        <input type="hidden" id="remarkId" name="remark_id" value="">
        <button id="deleteRemarkButton" class="alert button">Löschen</button>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
      {!! Form::close() !!}
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for deleting remarks:
          $('#table').on('click', '.deleteRemarkButton', function() {
            deleteRemarkModal(this);
          });
      });

      function deleteRemarkModal(obj){
        var remarkId = $(obj).attr('remarkId');
        $('#remarkId').val(remarkId);
      }
    </script>
    
@endsection