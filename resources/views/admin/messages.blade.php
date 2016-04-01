@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

      <div class="large-12 column">
        <button class="success button pull-right"><i class="fa fa-plus"></i> Neue Nachricht</button>
        <h1><i class="fa fa-envelope"></i> Nachrichten <div class="label">{{ count($conv1) }}</div></h1>
      </div>

      <div class="large-12 column">

            <h4>Ungelesene Nachrichten</h4>
      	
      	<div class="callout">
      		@foreach($conv1 as $conv)
      			<?php
      				$message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
      			?>
      			<a href="{{ URL('admin/messages/'.$conv->id) }}" class="divlink">
      				<div class="row">
			      		<div class="medium-1 small-2 columns">
                                        @if(($file = $conv->files()->where('slug','profile_img')->first()) != null)
                                        <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                                        @else
                                          Kein Foto
                                        @endif
				      	</div>
				      	<div class="medium-8 small-7 columns">
				      		<strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong>
				      		<p>{{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif</p>
				      	</div>
				      	<div class="medium-3 small-3 columns text-right">
				      		<em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em> <div class="ampel yellow"></div>
				      	</div>
			      </div>
      			</a>
      		@endforeach
      	</div>
      </div>

      <div class="large-12 column">

            <h4>Unbeantwortete Nachrichten</h4>
            
            <div class="callout">

                  @foreach($conv2 as $conv)
                        <?php
                              $message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
                        ?>
                        <a href="{{ URL('admin/messages/'.$conv->id) }}" class="divlink">
                              <div class="row">
                                    <div class="medium-1 small-2 columns">
                                          @if(($file = $conv->files()->where('slug','profile_img')->first()) != null)
                                    <img src="{{ URL::asset($file->path) }}" style="border-radius: 50%; margin-right: 1rem;">
                                  @else
                                    <img src="http://placehold.it/50x50" style="border-radius: 50%; margin-right: 1rem;">
                                  @endif
                                    </div>
                                    <div class="medium-8 small-7 columns">
                                          <strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong>
                                          <p>{{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif</p>
                                    </div>
                                    <div class="medium-3 small-3 columns text-right">
                                          <em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em>
                                    </div>
                        </div>
                        </a>
                  @endforeach

            </div>
      </div>

      <div class="large-12 column">

            <h4>Beantwortete Nachrichten</h4>
            
            <div class="callout">

                  @foreach($conv2 as $conv)
                        <?php
                              $message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
                        ?>
                        <a href="{{ URL('admin/messages/'.$conv->id) }}" class="divlink">
                              <div class="row">
                                    <div class="medium-1 small-2 columns">
                                          @if(($file = $conv->files()->where('slug','profile_img')->first()) != null)
                                    <img src="{{ URL::asset($file->path) }}" style="border-radius: 50%; margin-right: 1rem;">
                                  @else
                                    <img src="http://placehold.it/50x50" style="border-radius: 50%; margin-right: 1rem;">
                                  @endif
                                    </div>
                                    <div class="medium-8 small-7 columns">
                                          <strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong>
                                          <p>{{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif</p>
                                    </div>
                                    <div class="medium-3 small-3 columns text-right">
                                          <em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em>
                                    </div>
                        </div>
                        </a>
                  @endforeach

            </div>
      </div>

    </section>
  
@endsection