@extends('layouts.print')

@section('content')
<h1 style="text-align: center; font-size: 1.5rem;">{{ $raffle->title }}</h1>
<table class="full-width">
  <thead>
    <tr>
      <th width="200">Code</th>
      <th>Bemerkung</th>
      <th width="150">Kunde</th>
      <th width="150">Gültig bis</th>
    </tr>
  </thead>
  <tbody>
    @foreach($codes as $code)
    <tr>
      <td>{{ $code->code }}</td>
      <td>{{ $code->remark }}</td>
      <td>
        @if($code->user == null)
          Nicht zugewiesen
        @else
          {{ $code->user->firstname }} {{ $code->user->lastname }}
        @endif
      </td>
      <td>{{ date(trans('global.dateformat'),$code->endtime) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
    
@endsection