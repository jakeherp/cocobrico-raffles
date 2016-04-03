@extends('layouts.admin')

@section('content')
    
    <section class="row" id="content">

      <div class="large-12 column">
        {!! Form::open(['url' => 'admin/messages/changeState', 'method' => 'post']) !!}
          <input type="hidden" name="member_id" value="{{ $member->id }}">
          <button class="small alert button pull-right" name="unread" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="1" title="Als ungelesen markieren"><i class="fa fa-envelope"></i></button>
          <a class="small primary button pull-right" href="{{ URL('admin/users/'.$member->id) }}" data-tooltip aria-haspopup="true" data-disable-hover="false" tabindex="1" title="Zum Profil"><i class="fa fa-search"></i></a>
        {!! Form::close() !!}
        <h1><i class="fa fa-envelope"></i> Nachrichtenverlauf</h1>
        <p>mit 
        @if($member->firstname != '')
          {{ $member->firstname }} {{ $member->lastname }}
        @else
          {{ $member->email }}
        @endif
        </p>
      </div>

      <div class="chat large-12-column" id="chat">
        @foreach($member->messages as $message)
          @if($message->answer != 1)
            <div class="callout secondary large-9 small-11 pull-left">{{ $message->text }}<em>{{ date('d.m.Y H:m:i', $message->sent_at) }}</em>
          @else
            <div class="callout primary large-9 small-11 pull-right">{{ $message->text }}<em>{{ date('d.m.Y H:m:i', $message->sent_at) }}</em>
          @endif
            <a 
              class="close-button tiny deleteMessageButton" 
              aria-label="Dismiss alert" 
              messageId="{{ $message->id }}" 
              data-open="deleteMessageModal">
              <span aria-hidden="true">&times;</span>
            </a>
            </div>
        @endforeach
      </div>

      <div class="callout large-12 column">
        <div class="input-group">
          {{ Form::text('message', null, ['id' => 'message', 'class' => 'input-group-field', 'max-length' => '255', 'placeholder' => 'Hier kannst du deine Nachricht eingeben']) }}
          <div class="input-group-button">
            <a class="button alert" id="sendMessage" member = "{{ $member->id }}">Absenden</a>
          </div>
        </div>
      </div>

    </section>

    <!-- Modal for deleting messages -->
    <div class="reveal" id="deleteMessageModal" data-reveal>
      <h3>Nachricht löschen</h3>
      <div class="callout alert">Wollen Sie die Nachricht wirklich löschen?</div>
      {!! Form::open(['url' => 'admin/messages/delete', 'method' => 'post']) !!}
        <input type="hidden" id="messageId" name="message_id" value="">
        <button id="deleteMessageButton" class="alert button">Löschen</button>
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

          $("#sendMessage").click( function(){
            sendMessage();
          });

          $('#chat').on('click', '.deleteMessageButton', function() {
            deleteMessageModal(this);
          });

          scrollDown();

          setInterval(function(){ getNewMessages(); }, 10000);
      } )

      function deleteMessageModal(obj){
        var messageId = $(obj).attr('messageId');
        $('#messageId').val(messageId);
      }

      function sendMessage(){
        var message = $("#message").val();
        var message_id = $("#message_id").val();
        var member = $("#sendMessage").attr('member');
        if(message != ''){
          $("#message").removeClass('has-error');
          $.ajax({
            type: "POST",
            url: '../../admin/messages/send',
            data: {message: message, member_id: member},
            success: function( msg ) {
              var jsDate = new Date();
              var dateString = getFormattedDate(jsDate);

              $('#chat').append('<div class="callout primary large-9 small-11 pull-right">'+message+'<em>'+dateString+'</em><button class="close-button tiny" aria-label="Dismiss alert" message="'+message_id+'"><span aria-hidden="true">&times;</span></button></div>');

              $("#message").val('');
            }
          });
        }
        else{
          $("#message").addClass('has-error');
        }
      }

      function getNewMessages(){
        var user_id = $("#sendMessage").attr('member');
        $.ajax({
          type: "GET",
          url : "../../admin/messages/get/"+user_id,
          dataType : "json",
          success : function(data){
            $.each(data, function( index, value ) {
              var jsDate = new Date(value['sent_at']*1000);
              var dateString = getFormattedDate(jsDate);

              $('#chat').append('<div class="callout secondary large-9 small-11 pull-left">'+value['text']+'<em>'+dateString+'</em></div>');
            });
          }
        }, "json");
      }

      function getFormattedDate(date) {
        var year = date.getFullYear();
        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        var hours = date.getHours().toString();
        hours = hours.length > 1 ? hours : '0' + hours;
        var minutes =  date.getMinutes().toString();
        minutes = minutes.length > 1 ? minutes : '0' + minutes;
        var seconds = date.getSeconds().toString();
        seconds = seconds.length > 1 ? seconds : '0' + seconds;
        return day + '.' + month + '.' + year + ' ' + hours + ':' + minutes + ':' + seconds;
      }

      function scrollDown(){
        var box = $('#chat');
        var height = box[0].scrollHeight;
        box.scrollTop(height);
      }
    </script>
@endsection