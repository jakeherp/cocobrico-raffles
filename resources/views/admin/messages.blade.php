@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

      <div class="large-12 column">
        <a class="success button pull-right" data-open="newMessageModal"><i class="fa fa-plus"></i> Neue Nachricht</a>
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

                  @foreach($conv3 as $conv)
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

    <!-- Modal for new message -->
    <div class="reveal" id="newMessageModal" data-reveal>
      <h3>Neue Nachricht</h3>
      <p>Wählen Sie den Benutzer aus, an den Sie eine Nachricht senden möchten!</p>
        <select id="memberId">
        <?php
          $i = 0;
        ?>
        @foreach($members as $member)
          <?php
            if($i == 0){
              $firstId = $member->id;
              $i++;
            }
          ?>
          <option value="{{ $member->id }}">{{ $member->firstname }} {{ $member->lastname }}</option>
        @endforeach
        </select>
        <a id="startConversationButton" href="{{ URL('admin/messages/'.$firstId) }}" class="alert button">Konversation starten</a>
        <button type="reset" class="secondary button" data-close>Abbrechen</button>
        <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <script>
      $(document).ready(function() {
          // Functionality for starting new Conversation:
          $('#memberId').change( function() {
            var id = $(this).val();
            $('#startConversationButton').attr('href','{{ URL('admin/messages') }}/'+id)
          });
      });
    </script>
  
@endsection