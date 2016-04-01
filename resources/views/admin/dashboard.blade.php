@extends('layouts.admin')

@section('content')

<section class="row" id="content">

  	<div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-envelope"></i> Neue Nachrichten</h1>
          <a href="{{ url('admin/messages') }}">
            <div class="callout">
            @if( count($conv1) > 0)
              <div class="ampel yellow"></div>{{ count($conv1) }} neue Nachricht/en.
            @else
              <div class="ampel green"></div>Keine neuen Nachrichten.
            @endif
            </div>
          </a>
        </div>
      </div>
      <div class="row">
      	<div class="large-6 medium-6 small-12 columns">
          <h1><i class="fa fa-user"></i>Benutzerstatistik</h1>
          <table class="full-width">
            <thead>
              <tr>
                <th></th>
                <th>Anzahl</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Benutzer gesamt</td>
                <td>{{ count($members) }}</td>
              </tr>
              <tr>
                <td>Benutzer unvollständig</td>
                <td>{{ count($members->where('firstname','')) }}</td>
              </tr>
              <tr>
                <td>Newsletter abonniert</td>
                <td></td>
              </tr>
              <tr>
                <td>Neue Aktionen abonniert</td>
                <td></td>
              </tr>
              <tr>
                <td>Mail bei neuer Nachricht aktiviert</td>
                <td></td>
              </tr>
            </tbody>
          </table>
      	</div>
        <div class="large-6 medium-6 small-12 columns">
          <h1><i class="fa fa-tag"></i>Codes</h1>
          <table class="full-width">
            <thead>
              <tr>
                <th>Aktion</th>
                <th>Registriert</th>
                <th>Verwendete Codes</th>
              </tr>
            </thead>
            <tbody>
              @foreach($raffles as $raffle)
                <tr>
                  <td>{{ $raffle->title }}</td>
                  <td>{{ count($raffle->users) }}</td>
                  <td class="codecount">{{ count($raffle->codes()->where('user_id','!=',0)->get()) }} / {{ count($raffle->codes) }}
                  @if(count($raffle->codes) >= 1)
                    <div class="@if((((count($raffle->codes)-count($raffle->codes()->where('user_id','!=',0)->get()))/count($raffle->codes))*100) >= 60) success @elseif((((count($raffle->codes)-count($raffle->codes()->where('user_id','!=',0)->get()))/count($raffle->codes))*100) >= 20) warning @else alert @endif progress"><div class="progress-meter" style="width: {{ ((count($raffle->codes)-count($raffle->codes()->where('user_id','!=',0)->get()))/count($raffle->codes))*100 }}%"></div></div>
                  @else
                    <div class="alert progress"><div class="progress-meter" style="width: 5%"></div></div>
                  @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

</section>

@endsection