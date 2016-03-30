@extends('layouts.admin')

@section('content')

<section class="row" id="content">

  	<div class="row">
        <div class="large-12 columns">
          <h1><i class="fa fa-envelope"></i> Neue Nachrichten</h1>
          <div class="callout">

      	  <a href="#" class="divlink"><div class="row">
	      	  <div class="medium-1 small-2 columns">
	      		<img src="http://placehold.it/50x50" style="border-radius: 50%; margin-right: 1rem;">
	      	  </div>
	      	  <div class="medium-8 small-7 columns">
	      		<strong>Max Mustermann</strong>
	      		<p>Lorem ipsum dolor sit amet ...</p>
	      	  </div>
	      	  <div class="medium-3 small-3 columns text-right">
	      	  	<em>24.03.2016 15:23</em>
	      	  </div>
	      </div></a>
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
                <td>Ausgegeben</td>
                <td>Verwendet</td>
              </th>
            </thead>
            <tbody>
              <tr>
                <td>VIP Tickets Samstag</td>
                <td>120</td>
                <td>49</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

</section>

@endsection