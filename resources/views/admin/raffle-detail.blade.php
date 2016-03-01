@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

    	{{ $raffle->title }}<br>
        {{ $raffle->body }}<br>
        {{ date(trans('global.datetimeformat'), $raffle->start) }}<br>
        {{ date(trans('global.datetimeformat'), $raffle->end) }}<br><br>

        Teilnehmer: {{ count($members) }}

        <br><br>

        <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Teilnehmer</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th>Gewinnspiel Teilnahmen</th>
                <th>Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                 <tr>
                    <td>
                      @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                      <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                      @else
                        Kein Foto
                      @endif
                    </td>
                    <td>
                      {{ $member->firstname }} {{ $member->lastname }}
                    </td>
                    <td>
                      {{ date(trans('global.dateformat'),$member->birthday) }} ({{ floor((time() - $member->birthday) / 31556926) }} Jahre)</td>
                    <td>
                      {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}
                    </td>
                    <td><span class="has-tooltip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="
                      @foreach($member->raffles AS $raffle)
                        {{ $raffle->title }} 
                      @endforeach
                    ">
                      {{ count($member->raffles) }}
                    </span></td>
                    <td>
                      <a href="{{ URL('admin/users/'.$member->id) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Details anzeigen"><i class="fa fa-search"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>

@endsection