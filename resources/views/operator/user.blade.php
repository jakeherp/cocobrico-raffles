@extends('layouts.operator')

@section('content')

<section class="row" id="content">
	<div class="large-12 column">
		<h1>{{ $member->firstname }} {{ $member->lastname }}</h1>

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
			              @foreach($member->raffles as $raffle)
			                 <tr>
			                    <td>{{ $raffle->title }}</td>
			                    <td>{{ $raffle->eventDate }}</td>
			                    <td><button class="success button"><i class="fa fa-check-square-o"></i> Checkin</button></td>
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

@endsection