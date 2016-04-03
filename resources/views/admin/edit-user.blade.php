@extends('layouts.admin')

@section('content')
    <section class="row" id="content">

  	  <div class="large-12 column">
        <h1><i class="fa fa-user"></i> User bearbeiten</h1>

        @include ('errors.list')
        
        <div class="callout">
		  {!! Form::open(['url' => 'admin/users/edit', 'method' => 'post']) !!}
        {!! Form::hidden('_method', 'PUT', []) !!}
        {!! Form::hidden('id', $member->id) !!}
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-envelope"></i></span>
            {!! Form::email('email', $member->email, ['class' => 'input-group-field', 'placeholder' => trans('auth.email')]) !!}
        </div>
        <label>
          Persönliche Daten
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-user"></i></span>
              {!! Form::text('firstname', $member->address->firstname, ['class' => 'input-group-field', 'placeholder' => trans('auth.firstname')]) !!}
          </div>
        </label>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-user"></i></span>
          {!! Form::text('lastname', $member->address->lastname, ['class' => 'input-group-field', 'placeholder' => trans('auth.lastname')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-venus-mars"></i></span>
          <select name="gender" class="input-group-field">
            <option value="0" @if($member->gender == 0) selected @endif>Männlich</option>
            <option value="1" @if($member->gender == 1) selected @endif>Weiblich</option>
          </select>
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-phone"></i></span>
          {!! Form::text('phone', $member->address->phone, ['class' => 'input-group-field', 'placeholder' => trans('auth.phone')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-phone"></i></span>
          {!! Form::text('fax', $member->address->fax, ['class' => 'input-group-field', 'placeholder' => trans('auth.fax')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-calendar"></i></span>
          {!! Form::date('birthday', date('Y-m-d',$member->birthday), ['class' => 'input-group-field', 'placeholder' => trans('auth.birthday')]) !!}
        </div>
        <label>
          Weitere Informationen
        </label>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-home"></i></span>
          {!! Form::text('address1', $member->address->address1, ['class' => 'input-group-field', 'placeholder' => trans('auth.address1')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-home"></i></span>
          {!! Form::text('address2', $member->address->address2, ['class' => 'input-group-field', 'placeholder' => trans('auth.address2')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-building"></i></span>
          {!! Form::text('zipcode', $member->address->zipcode, ['class' => 'input-group-field', 'placeholder' => trans('auth.postcode')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-map"></i></span>
          {!! Form::text('city', $member->address->city, ['class' => 'input-group-field', 'placeholder' => trans('auth.city')]) !!}
        </div>
        <div class="input-group">
          <span class="input-group-label"><i class="fa fa-globe"></i></span>
          <select name="country" class="input-group-field">
            <option value="80" @if($member->address->country_id == 80) selected @endif>Deutschland</option>
            <option value="14" @if($member->address->country_id == 14) selected @endif>Österreich</option>
            <option value="206" @if($member->address->country_id == 206) selected @endif>Schweiz</option>
            <option value="80">-------------</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}" @if($member->address->country_id == $country->id) selected @endif>{{ $country->name }}</option>
            @endforeach
          </select>
        </div>
        <label>
          Rolle
          <div class="input-group">
            <span class="input-group-label"><i class="fa fa-star"></i></span>
            <select name="role" class="input-group-field">
              <option value="is_user">Benutzer</option>
              <option value="is_operator" 
              @if(!$member->hasPermission('is_admin') && $member->hasPermission('is_operator')) selected @endif>Operator</option>
              <option value="is_admin" 
               @if($member->hasPermission('is_admin')) selected @endif>Administrator</option>
            </select>
          </div>
        </label>
        <div class="input-group">
            <span class="input-group-label"><i class="fa fa-comment"></i></span>
            {{ Form::textarea('remark', $member->remark, ['class' => 'input-group-field', 'placeholder' => 'Kommentar']) }}
        </div>
        <label>
          <div class="input-group">
            {!! Form::checkbox('sendNotification', '1', true) !!} Benachrichtigt den Benutzer über die Änderungen per Email. 
          </div>
        </label>
        {!! Form::submit('Änderungen speichern', ['class' => 'button alert']) !!}
        <a class="button secondary" href="{{ URL('admin/users') }}">Zurück</a>
		  {!! Form::close() !!}
        </div>
      </div>

    </section>
@endsection