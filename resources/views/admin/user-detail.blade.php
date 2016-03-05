@extends('layouts.admin')

@section('content')

    <section class="row" id="content">
      <div class="large-12 column">
        <h1>{{ $member->firstname }} {{ $member->lastname }}</h1>
        <div class="callout">

    @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
        <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;width:6rem;height:6rem;float:right;"></div>
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
        <h4>Der User hat an folgenden Gewinnspielen teilgenommen:</h4>
        <div class="callout">
            @foreach($member->raffles as $raffle)
                {{ $raffle->title }}
                <br>
            @endforeach
        </div>
      </div>
    </section>
	
@endsection