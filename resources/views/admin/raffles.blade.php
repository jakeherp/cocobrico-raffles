@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
      	<a href="{{ url('admin/raffles/create') }}" class="pull-right success button"><i class="fa fa-plus"></i> Gewinnspiel hinzufügen</a>
        <h1><i class="fa fa-trophy"></i> Gewinnspiele</h1>
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Startdatum</th>
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
                    <td>{{ date(trans('global.datetimeformat'), $raffle->end) }}</td>
                    <td>{{ count($raffle->users) }}</td>
                    <td>
                      <a href="#" class="tiny button warning has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.edit') }}"><i class="fa fa-pencil"></i></a>
                      <a href="#" class="tiny button success has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.copy') }}"><i class="fa fa-clone"></i></a>
                      <a href="#" class="tiny button alert has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.cancel') }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>
    
@endsection