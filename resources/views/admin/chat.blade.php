@extends('layouts.admin')

@section('content')
    
    <section class="row" id="content">

      <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Nachrichtenverlauf</h1>
        <p>mit {{ $member->firstname }} {{ $member->lastname }}</p>
      </div>

      <div class="chat large-12-column" id="chat">

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


    <script type="text/javascript">
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).ready(function() {
          $(".chat").scrollTop($(".chat")[0].scrollHeight);

          getMessages();

          $("#sendMessage").click( function(){
            sendMessage();
          });

          setInterval(function(){ getMessages(); }, 10000);
      } )

      function sendMessage(){
        var message = $("#message").val();
        var member = $("#sendMessage").attr('member');
        if(message != ''){
          $("#message").removeClass('has-error');
          $.ajax({
            type: "POST",
            url: '../../admin/messages/send',
            data: {message: message, member_id: member},
            success: function( msg ) {
              $("#message").val('');
              getMessages();
            }
          });
        }
        else{
          $("#message").addClass('has-error');
        }
      }

      function getMessages(){
        $('#chat').empty();
        $.ajax({
          type: "GET",
          url : "../../messages/get",
          dataType : "json",
          success : function(data){
            $.each(data, function( index, value ) {
              var jsDate = new Date(value['sent_at']*1000);
              var dateString = getFormattedDate(jsDate);

              if(value['answer'] != 1){
                $('#chat').append('<div class="callout secondary large-9 small-11 pull-left">'+value['text']+'<em>'+dateString+'</em></div>');
              }
              else{
                $('#chat').append('<div class="callout primary large-9 small-11 pull-right">'+value['text']+'<em>'+dateString+'</em></div>');
              }
              console.log(value['text']);
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
    </script>
@endsection