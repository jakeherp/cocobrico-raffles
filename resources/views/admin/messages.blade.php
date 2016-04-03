@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

      <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Nachrichten <div class="label">{{ count($conv1) }}</div></h1>
      </div>

      <div class="large-12 column">
        <table class="full-width">
          @foreach($conv1 as $conv)
            <?php
              $message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
            ?>
            <tr onclick="document.location = '{{ URL('admin/messages/'.$message->user->id) }}';" style="cursor:pointer;">
              <td>
                @if(time()-$message->sent_at > (48*3600))
                  <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="> 48h" ><div class="ampel red"></div></a>
                @else
                  <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 48h" ><div class="ampel yellow"></div></a>
                @endif
              </td>
              <td>
                <strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong> {{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif
              </td>
              <td>
                <em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em> 
              </td>
            </tr>
          @endforeach
          @foreach($conv2 as $conv)
            <?php
              $message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
            ?>
            <tr onclick="document.location = '{{ URL('admin/messages/'.$message->user->id) }}';" style="cursor:pointer;">
              <td>
                @if(time()-$message->sent_at > (48*3600))
                  <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="> 48h" ><div class="ampel red"></div></a>
                @else
                  <a data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="< 48h" ><div class="ampel yellow"></div></a>
                @endif
              </td>
              <td>
                <strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong> {{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif
              </td>
              <td>
                <em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em> 
              </td>
            </tr>
          @endforeach
        </table>

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