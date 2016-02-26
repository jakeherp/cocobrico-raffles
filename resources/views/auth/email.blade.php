@extends('layouts.auth')

@section('content')

	<section class="row" id="login">
      <div class="large-6 small-12 large-centered columns">
        <div class="callout large">
          <h3>{{ trans('auth.signin') }}</h3>
          <p>{{ trans('auth.signindesc') }}</p>

          @include ('errors.list')

          @if(session()->has('messages'))
                @foreach (session('messages') as $message)
                    <div class="callout success">
                        {{ $message }}
                    </div>
                @endforeach
          @endif

            {!! Form::open(array('url' => 'identify', 'method' => 'post')) !!}
              <div class="row">
                <div class="large-12 columns">
                
                  <div class="input-group">
                    <span class="input-group-label"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('email', null, ['class' => 'input-group-field', 'placeholder' => trans('auth.email')]) !!}
                    <div class="input-group-button">
                      {!! Form::submit(trans('auth.validate'), ['class' => 'button alert']) !!}
                    </div>
                  </div>
                                
                </div>
              </div>
            {!! Form::close() !!}
            
        </div>
      </div>
    </section>
	
@endsection