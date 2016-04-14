@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <a href="{{ url('admin/users/newsletter') }}" class="pull-right small alert button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Newsletter Abonnenten CSV Download"><i class="fa fa-download"></i></a>
        <h1><i class="fa fa-user"></i> Mitglieder</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="no-sort"></th>
                <th class="no-sort"></th>
                <th>Name</th>
                <th>M/W</th>
                <th class="orderby">Geburtsdatum</th>
                <th>Mitglied seit</th>
                <th>Aktionen</th>
                <th>?</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                @if($member->active == 0)
                  <tr class="cancelled" onclick="document.location = '{{ URL('admin/users/'.$member->id) }}';" style="cursor:pointer;">
                @else
                  <tr onclick="document.location = '{{ URL('admin/users/'.$member->id) }}';" style="cursor:pointer;">
                @endif
                    <td>
                      @if(($file = $member->files()->where('slug','profile_img')->first()) != null)
                      <div class="round-image" style="background:url('{{ URL::asset($file->path) }}') no-repeat center center;background-size:cover;"></div>
                      @else
                        Kein Foto
                      @endif
                    </td>
                    <td>
                      @if( count($member->messages) > 0 )
                        <a href="{{ URL('admin/messages/'.$member->id) }}" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Nachrichtenverlauf"><i class="fa fa-envelope"></i></a>
                      @endif
                      @if( count($member->remarks) > 0 )
                        <a href="{{ URL('admin/users/'.$member->id.'/remarks') }}" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Kommentare"><span style="color: green">R</span></a>
                      @endif
                    </td>
                    <td>
                      @if($member->firstname == '' && $member->lastname == '')
                        {{ $member->email }}
                      @else
                        {{ $member->firstname }} {{ $member->lastname }}
                      @endif
                    </td>
                    <td>
                      @if($member->gender == 0)
                        M
                      @elseif($member->gender == 1)
                        W
                      @endif
                    </td>
                    <td>
                      {{ floor((time() - $member->birthday) / 31556926) }} Jahre - {{ date(trans('global.dateformat'),$member->birthday) }}</td>
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
                      @if($member->hasPermission('change_details') || $member->hasPermission('change_picture'))
                        ?
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