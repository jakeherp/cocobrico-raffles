@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
        <h1>{{ $raffle->title }}</h1>
        <div class="callout">
          <p><strong>Start:</strong> {{ date(trans('global.datetimeformat'), $raffle->start) }}, 
          <strong>Ende:</strong> {{ date(trans('global.datetimeformat'), $raffle->end) }}</p>
          <p>{!! $raffle->body !!}</p>
          <a class="button secondary" href="{{ URL('admin/raffles') }}">Zurück</a>
          <a class="button secondary" href="{{ URL('admin/raffles/'.$raffle->id.'/pdf') }}">PDF Vorschau</a>

          <?php
            $file = $raffle->files()->where('slug','raffle_img')->first();
          ?>

          <p>Aktionsgrafik:</p>
          @if($file != null)
            <img src="{{ URL::asset($file->path) }}">
          @else
            Keine Grafik vorhanden
          @endif
        </div>
      </div>

        <div class="large-12 column">
        <h1><i class="fa fa-user"></i> Teilnehmer <span class="label">{{ count($members) }}</span></h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th>Name</th>
                <th>Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th class="orderby">Teilnahme</th>
                <th>Aktionen</th>
                <th class="no-sort">Optionen</th>
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
                      {{ floor((time() - $member->birthday) / 31556926) }} Jahre - {{ date(trans('global.dateformat'),$member->birthday) }}</td>
                    <td>
                      {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}
                    </td>
                    <td>
                      {{ date(trans('global.dateformat'),strtotime($raffle->created_at)) }}
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