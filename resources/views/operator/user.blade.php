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
					<h5>Zutritt (RAFFLE_TITLE)</h5>
					Reservierungsnummer: <br>
					Bestätigungscode: <br>
					Teilnahmedatum: <br>
					Zutritt gestattet: <strong><?=date("d.m.Y H:i:s")?></strong><br><br>

					<h5>Persönliche Daten:</h5>
					Email Adresse: {{ $member->email }}<br>
					Anschrift: <br>
					Mitglied seit:
				</div>
			</div>
		</div>
	</div>

	<div class="small-12 column">
		<button class="extralarge expanded alert button"><i class="fa fa-ban"></i><br>STOP</button>
	</div>

</section>

@endsection