@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
        <h1>{{ $member->firstname }} {{ $member->lastname }}</h1>
        <div class="callout">

    @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
        <a href="{{ URL::asset($file->path) }}" target="_blank"><img src="{{ URL::asset($file->path) }}" class="pull-right" style="max-height: 200px;"></a>
    @endif

          <p>
          <h4>Adresse:</h4>
            {{ $member->address->address1 }} {{ $member->address->address2 }}<br>
            {{ $member->address->zipcode }} {{ $member->address->city }}<br>
            {{ $member->address->country->name }}<br><br>
            <strong>Telefon:</strong> <a href="tel:{{ $member->address->phone }}">{{ $member->address->phone }}</a><br>
            <strong>Email:</strong> <a href="mailto:{{ $member->email }}"> {{ $member->email }}</a><br>

            <strong>Geburtstag:</strong> {{ date(trans('global.dateformat'),$member->birthday) }}<br>
            <strong>Mitglied seit:</strong> {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}<br>
          </p>
        </div>
      </div>
      <div class="large-12 column">
        <h4>Der User hat an folgenden Aktionen teilgenommen:</h4>

        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Aktion</th>
                <th class="orderby">Teilnahme</th>
                <th>Bestätigt</th>
                <th>Code</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($member->raffles as $raffle)
                 <tr>
                    <td>
                      {{ $raffle->title }}
                    </td>
                    <td>
                      {{ date(trans('global.datetimeformat'),strtotime($raffle->users()->find($member->id)->pivot->created_at)) }}
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      
                    </td>
                    <td>
                      <a href="{{ URL('admin/raffles/'.$raffle->id) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                      <a data-open="userWinModal" class="tiny success button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Bestätigen"><i class="fa fa-trophy"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
	
@endsection