@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-comment"></i> Kommentar bearbeiten</h1>

        @include ('errors.list')
        
        <div class="callout">
		    {!! Form::open(['url' => 'admin/users/remarks/edit', 'method' => 'post']) !!}
        {!! Form::hidden('_method', 'PUT', []) !!}
        {!! Form::hidden('id', $remark->id) !!}
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
            {!! Form::text('title', $remark->title, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
            {{ Form::textarea('body', $remark->body, ['class' => 'input-group-field', 'placeholder' => 'Kommentartext']) }}
          </div>
          <label>
            <div class="input-group">
              <i class="fa fa-eye-slash"></i>
              @if($remark->visible == 1)
                {!! Form::checkbox('visible', '1', true) !!} Der Kommentar ist für den Benutzer sichtbar.
              @else
                {!! Form::checkbox('visible', '1', false) !!} Der Kommentar ist für den Benutzer sichtbar.
              @endif
            </div>
          </label>
          {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
          <a class="button secondary" href="{{ URL('admin/users/'.$remark->user_id.'/remarks') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection