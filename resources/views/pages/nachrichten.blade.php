@extends(($user == null) ? 'layouts.auth' : 'layouts.app')

@section('content')
    
    <section class="row" id="content">

      <div class="large-12 column">
        <h1><i class="fa fa-envelope"></i> Nachrichtenverlauf</h1>
      </div>

      <div class="chat large-12-column">
        <div class="callout secondary large-9 small-11 pull-left">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          <em>24. März 2016 um 18:29</em>
        </div>

        <div class="callout primary large-9 small-11 pull-right">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          <em>24. März 2016 um 18:29</em>
        </div>

        <div class="callout secondary large-9 small-11 pull-left">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          <em>24. März 2016 um 18:29</em>
        </div>

        <div class="callout secondary large-9 small-11 pull-left">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          <em>24. März 2016 um 18:29</em>
        </div>

        <div class="callout primary large-9 small-11 pull-right">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          <em>24. März 2016 um 18:29</em>
        </div>
      </div>

      <div class="callout large-12 column">
        <div class="input-group">
          {{ Form::text('email', null, ['class' => 'input-group-field', 'max-length' => '255', 'placeholder' => 'Hier kannst du deine Nachricht eingeben']) }}
          <div class="input-group-button">
            {!! Form::submit('Absenden', ['class' => 'button alert']) !!}
          </div>
        </div>
      </div>

    </section>


    <script type="text/javascript">
      $(document).ready(function() {
          $(".chat").scrollTop($(".chat")[0].scrollHeight);
      } )
    </script>
@endsection