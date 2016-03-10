@extends('layouts.admin')

@section('content')

    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-tag"></i> Codes für Aktionen</h1>
        @if(session()->has('msg'))
          <div class="callout {{ session('msgState') }}">
            <p>{{ session('msg') }}</p>
          </div>
        @endif
        <div class="horizontal-scroll">
          <table id="table" class="full-table">
            <thead>
              <tr>
                <th class="orderby">Aktion</th>
                <th>Anzahl Codes</th>
                <th class="no-sort">Optionen</th>
              </tr>
            </thead>
            <tbody>
              @foreach($raffles as $raffle)
                 <tr>
                    <td>{{ $raffle->title }}</td>
                    <td>{{ count($raffle->codes) }}</td>
                    <td>
                      <a href="{{ url('admin/codes/'. $raffle->id ) }}" class="tiny button" data-tooltip aria-haspopup="true" data-disable-hover='false' tabindex=1 title="Codes zu Aktion anzeigen"><i class="fa fa-search"></i></a>
                      <a 
                        href="{{ url('admin/codes/'. $raffle->id . '/create' ) }}"
                        class="tiny button success" 
                        data-tooltip aria-haspopup="true" 
                        data-disable-hover='false' 
                        tabindex=1 
                        title="Codes hinzufügen"
                      ><i class="fa fa-plus"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </section>
    
@endsection