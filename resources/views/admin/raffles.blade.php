@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
      	<a href="#" class="pull-right success button"><i class="fa fa-plus"></i> Gewinnspiel hinzufügen</a>
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
              <tr>
                <td>Gewinnspiel 1</td>
                <td>01.01.2016 00:00 Uhr</td>
                <td>15.04.2016 12:00 Uhr</td>
                <td>2093</td>
                <td>
                  <a href="#" class="tiny button warning has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.edit') }}"><i class="fa fa-pencil"></i></a>
                  <a href="#" class="tiny button success has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.copy') }}"><i class="fa fa-clone"></i></a>
                  <a href="#" class="tiny button alert has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.cancel') }}"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>Gewinnspiel 2</td>
                <td>01.01.2016 00:00 Uhr</td>
                <td>15.04.2016 12:00 Uhr</td>
                <td>2093</td>
                <td>
                  <a href="#" class="tiny button warning has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.edit') }}"><i class="fa fa-pencil"></i></a>
                  <a href="#" class="tiny button success has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.copy') }}"><i class="fa fa-clone"></i></a>
                  <a href="#" class="tiny button alert has-tip" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="{{ trans('orders.cancel') }}"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </section>
    
@endsection