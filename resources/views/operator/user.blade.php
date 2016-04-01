@extends('layouts.operator')

@section('content')

<section class="row" id="content">
	<div class="large-12 column">
		<h1>{{ $member->firstname }} {{ $member->lastname }}</h1>
		@if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{!! session('msg') !!}</p>
          </div>
        @endif
		<div class="callout">	
			<div class="row">
				<div class="medium-3 small-12 columns">
					@if(($file = $member->files()->where('slug','profile_img')->first()) != null)
						<img src="{{ URL::asset($file->path) }}">
					@endif
				</div>
				<div class="medium-9 small-12 columns">
					<h5>Aktionen</h5>
			          <table class="full-width">
			            <thead>
			              <tr>
			                <th>Name</th>
			                <th>Eventdatum</th>
			                <th>Aktion</th>
			              </tr>
			            </thead>
			            <tbody>
			              @foreach($raffles as $raffle)
			                 <tr>
			                    <td>{{ $raffle->title }}</td>
			                    <td>{{ date(trans('global.dateformat'),$raffle->eventDate) }}</td>
			                    @if($raffle->hasUser($member->id) && $raffle->users()->find($member->id)->pivot->confirmed == 1)
			                    	<td>
			                    		<a 
				                        class="alert button noActionButton" 
				                        timestamp="{{ date(trans('global.datetimeformat'),strtotime($raffle->users()->find($member->id)->pivot->updated_at)) }}" 
				                        data-tooltip aria-haspopup="true" 
				                        data-disable-hover='false' 
				                        tabindex=1 
				                        title="Löschen" 
				                        data-open="noActionModal" 
				                      	><i class="fa fa-check-square-o"></i> Checkin</a>
				                      </td>
			                    @elseif($raffle->hasUser($member->id))
				                    {!! Form::open(['url' => 'operator/checkin', 'method' => 'post']) !!}
								        {!! Form::hidden('_method', 'PUT', []) !!}
								        <input type="hidden" name="user_id" value="{{ $member->id }}">
								        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
				                    	<td><button class="success button"><i class="fa fa-check-square-o"></i> Checkin</button></td>
				                    {!! Form::close() !!}
			                    @else
			                    	{!! Form::open(['url' => 'operator/register', 'method' => 'post']) !!}
								        {!! Form::hidden('_method', 'PUT', []) !!}
								        <input type="hidden" name="user_id" value="{{ $member->id }}">
								        <input type="hidden" name="raffle_id" value="{{ $raffle->id }}">
				                    	<td><button class="warning button"><i class="fa fa-check-square-o"></i> Registrieren</button></td>
				                    {!! Form::close() !!}
			                    @endif
			                 </tr>
			              @endforeach
			            </tbody>
			          </table>

					<h5>Persönliche Daten:</h5>
					Email Adresse: {{ $member->email }}<br>
					Geburtsdatum: {{ date(trans('global.dateformat'),$member->birthday) }} ({{ floor((time() - $member->birthday) / 31556926) }} Jahre)<br>
					Anschrift: <br>
					@if($member->address != null)
		              {{ $member->address->address1 }} {{ $member->address->address2 }}<br>
		              {{ $member->address->zipcode }} {{ $member->address->city }}<br>
		              {{ $member->address->country->name }}<br><br>
		            @endif
					Mitglied seit: {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}
				</div>
			</div>
		</div>
	</div>

</section>

    <div class="reveal" id="noActionModal" data-reveal>
      <h3>Code schon verwendet</h3>
      <p id="timestamp"></p>
      <div class="callout alert">Keine weitere Aktion möglich.</div>
      <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

     <script>
      $(document).ready(function() {
          $('.noActionButton').click( function() {
             	var timestamp = $(this).attr('timestamp');
        		$('#timestamp').html(timestamp);
          });
      });
    </script>

@endsection