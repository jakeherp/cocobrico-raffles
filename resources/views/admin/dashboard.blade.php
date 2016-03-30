@extends('layouts.admin')

@section('content')

<section class="row" id="content">

  	<div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-envelope"></i> Neue Nachrichten</h1>
          <div class="callout">
          @if( count($conv1) > 0)
            @foreach($conv1 as $conv)
              <?php
                $message =  $conv->messages()->orderBy('sent_at', 'desc')->first();
              ?>
              <a href="{{ URL('admin/messages/'.$conv->id) }}" class="divlink">
                <div class="row">
                  <div class="medium-1 small-2 columns">
                    @if(($file = $conv->files()->where('slug','profile_img')->first()) != null)
                          <img src="{{ URL::asset($file->path) }}" style="border-radius: 50%; margin-right: 1rem;">
                        @else
                          <img src="http://placehold.it/50x50" style="border-radius: 50%; margin-right: 1rem;">
                        @endif
                  </div>
                  <div class="medium-8 small-7 columns">
                    <strong>{{ $conv->firstname }} {{ $conv->lastname }}</strong>
                    <p>{{ substr($message->text,0,50) }} @if(strlen($message->text) > 50) ... @endif</p>
                  </div>
                  <div class="medium-3 small-3 columns text-right">
                    <em>{{ date(trans('global.datetimeformat'),$message->sent_at) }}</em>
                  </div>
              </div>
              </a>
            @endforeach
          @else
            <p>Keine neuen Nachrichten.</p>
          @endif

	      </div>
        </div>
      </div>
      <div class="row">
      	<div class="large-6 medium-6 small-12 columns">
          <h1><i class="fa fa-user"></i>Neue Benutzer</h1>
          <table class="full-width">
            <thead>
              <th>
                <td>Benutzer</td>
                <td>Mitglied seit</td>
              </th>
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
                <td>{{ $member->firstname }} {{ $member->lastname }}</td>
                <td>{{ date(trans('global.dateformat'),strtotime($member->created_at)) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      	</div>
        <div class="large-6 medium-6 small-12 columns">
          <h1><i class="fa fa-tag"></i>Codes</h1>
          <table class="full-width">
            <thead>
              <th>
                <td>Vorhanden</td>
                <td>Verwendet</td>
              </th>
            </thead>
            <tbody>
              @foreach($raffles as $raffle)
                <tr>
                  <td>{{ $raffle->title }}</td>
                  <td>{{ count($raffle->codes) }}</td>
                  <td>{{ count($raffle->codes()->where('user_id','!=',0)->get()) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

</section>

@endsection