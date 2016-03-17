@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-file-pdf-o"></i> PDF hinzufügen</h1>

        @include ('errors.list')

        <div class="callout">
		  {!! Form::open(['url' => 'admin/pdf/create', 'method' => 'post']) !!}
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-book"></i></span>
                {!! Form::text('title', null, ['class' => 'input-group-field', 'placeholder' => 'Titel']) !!}
          </div>
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-pencil"></i></span>
                {!! Form::text('description', null, ['class' => 'input-group-field', 'maxlength' => '100', 'placeholder' => 'Beschreibung (Wird nicht in der PDF angezeigt!)']) !!}
          </div>
		      <div class="input-group">
            <span class="input-group-label"><i class="fa fa-edit"></i></span>
                {!! Form::textarea('body', null, ['class' => 'input-group-field tinymce', 'placeholder' => 'HTML-Body']) !!}
          </div>
          <p>Verwendbare Variablen: <span class="label">[date]</span> <span class="label">[firstname]</span> <span class="label">[lastname]</span> <span class="label">[email]</span> <span class="label">[birthday]</span> <span class="label">[created_at]</span> <span class="label">[actionTitle]</span> <span class="label">[actionBody]</span> <span class="label">[logo]</span> <span class="label">[qrCode]</span> <span class="label">[profilePicture]</span> <span class="label">[pCode]</span> <span class="label">[actionPicture]</span></p>
          {!! Form::submit('PDF erstellen', ['class' => 'button alert']) !!}
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
    
@endsection