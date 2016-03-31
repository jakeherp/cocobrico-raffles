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
			          <table id="table" class="full-table">
			            <thead>
			              <tr>
			                <th>Name</th>
			                <th class="orderby">Startdatum</th>
			                <th>Enddatum</th>
			                <th>Teilnehmer</th>
			                <th>Optionen</th>
			              </tr>
			            </thead>
			            <tbody>
			              @foreach($raffles as $raffle)
			                 <tr>
			                    <td>{{ $raffle->title }}</td>
			                    <td>{{ date(trans('global.datetimeformat'), $raffle->start) }}</td>
			                    @if($raffle->endState == 0)
			                      <td>Unbegrenzt</td>
			                    @elseif($raffle->end <= $raffle->start)
			                      <td class="has-alert">{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
			                    @elseif(time() >= $raffle->end)
			                      <td class="has-success">{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
			                    @else
			                      <td>{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
			                    @endif
			                      @if($raffle->maxpState == 0)
			                        <td> {{ count($raffle->users) }} </td>
			                      @elseif(count($raffle->users) >= $raffle->maxp)
			                        <td class="has-success"> {{ count($raffle->users) }} / {{ $raffle->maxp }}</td>
			                      @else
			                        <td> {{ count($raffle->users) }} / {{ $raffle->maxp }}</td>
			                      @endif
			                    </td>
			                    <td>
			                      <a href="{{ url('admin/raffles/'. $raffle->id ) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Teilnehmer anzeigen"><i class="fa fa-search"></i></a>
			                      <a 
			                        href="{{ url('admin/raffles/'. $raffle->id . '/edit' ) }}"
			                        class="tiny button warning editRaffleButton" 
			                        data-tooltip aria-haspopup="true" 
			                        data-disable-hover='false' 
			                        tabindex=1 
			                        title="Bearbeiten"
			                      ><i class="fa fa-pencil"></i></a>
			                      <a href="{{ url('admin/raffles/'. $raffle->id .'/emails' ) }}" class="tiny button success" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Emails zuordnen"><i class="fa fa-envelope"></i></a>
			                      <a 
			                        class="tiny button alert deleteRaffleButton" 
			                        raffleId="{{ $raffle->id }}" 
			                        data-tooltip aria-haspopup="true" 
			                        data-disable-hover='false' 
			                        tabindex=1 
			                        title="Löschen" 
			                        data-open="deleteRaffleModal" 
			                      ><i class="fa fa-trash"></i></a>
			                    </td>
			                  </tr>
			              @endforeach
			            </tbody>
			          </table>

					<h5>Persönliche Daten:</h5>
					Email Adresse: {{ $member->email }}<br>
					Geburtsdatum: {{ date(trans('global.dateformat'),$member->birthday) }} ({{ floor((time() - $member->birthday) / 31556926) }} Jahre)<br>
					Anschrift: <br>
					Mitglied seit:
				</div>
			</div>
		</div>
	</div>

</section>

@endsection