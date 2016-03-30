@extends(($user == null) ? 'layouts.auth' : 'layouts.app')

@section('content')
    
    <section class="row" id="content">

      <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Nachrichtenverlauf</h1>
      </div>

      <div class="chat large-12-column" id="chat">

        @foreach($user->messages as $message)
          @if($message->answer == 1)
            <div class="callout secondary large-9 small-11 pull-left">{{ $message->text }}<em>{{ date('d.m.Y H:m:i', $message->sent_at) }}</em></div>
          @else
            <div class="callout primary large-9 small-11 pull-right">{{ $message->text }}<em>{{ date('d.m.Y H:m:i', $message->sent_at) }}</em></div>
          @endif
        @endforeach

      </div>

      <div class="callout large-12 column">
        <div class="input-group">
          {{ Form::text('message', null, ['id' => 'message', 'class' => 'input-group-field', 'max-length' => '255', 'placeholder' => 'Hier kannst du deine Nachricht eingeben']) }}
          <div class="input-group-button">
            <a class="button alert" id="sendMessage">Absenden</a>
          </div>
        </div>
      </div>

    </section>


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

          scrollDown();

          setInterval(function(){ getNewMessages(); }, 10000);
      } );

      function sendMessage(){
        var message = $("#message").val();
        if(message != ''){
          $("#message").removeClass('has-error');
          $.ajax({
            type: "POST",
            url: 'messages/send',
            data: {message: message},
            success: function( msg ) {
              var jsDate = new Date();
              var dateString = getFormattedDate(jsDate);

              $('#chat').append('<div class="callout primary large-9 small-11 pull-right">'+message+'<em>'+dateString+'</em></div>');

              $("#message").val('');
            }
          });
        }
        else{
          $("#message").addClass('has-error');
        }
      }

      function getNewMessages(){
        $.ajax({
          type: "GET",
          url : "messages/get",
          dataType : "json",
          success : function(data){
            $.each(data, function( index, value ) {
              var jsDate = new Date(value['sent_at']*1000);
              var dateString = getFormattedDate(jsDate);

              if(value['answer'] == 1){
                $('#chat').append('<div class="callout secondary large-9 small-11 pull-left">'+value['text']+'<em>'+dateString+'</em></div>');
              }
              else{
                $('#chat').append('<div class="callout primary large-9 small-11 pull-right">'+value['text']+'<em>'+dateString+'</em></div>');
              }
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