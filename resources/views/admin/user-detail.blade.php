@extends('layouts.admin')

@section('content')

	{{ $member->firstname }}<br>
	{{ $member->lastname }}<br>
	{{ $member->email }}<br>
	Geburtstag: {{ date(trans('global.dateformat'),$member->birthday) }}<br>
	Registriert seit: {{ date(trans('global.dateformat'),strtotime($member->created_at)) }}<br>

	@if(($file = $member->files()->where('slug','profile_img')->first()) != null)
        <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
    @else
        Kein Foto
    @endif

    {{ $member->address->address1 }}
    {{ $member->address->address2 }}
    {{ $member->address->zipcode }}
    {{ $member->address->city }}
    {{ trans('localization.'.$member->address->country->iso) }}
    {{ $member->address->phone }}
    {{ $member->address->fax }}
    <br>
    Der User hat an folgenden Gewinnspielen teilgenommen:<br>
    @foreach($member->raffles as $raffle)
    	{{ $raffle->title }}
    	<br>
    @endforeach

@endsection