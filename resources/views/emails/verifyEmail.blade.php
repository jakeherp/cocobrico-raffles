<body style="background: #000;">
	<img src="{{ URL::asset('img/logo.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>{{ trans('auth.dear') }}</p>
		<p>{{ trans('auth.msgbody') }}</p>

		<p style="text-align: center; margin: 30px 0;">
			<span style="border: 2px solid #ee1d23; padding: 10px; color: #ee1d23; font-size: 1.25em;">
				{!! link_to('http://cb.pcserve.eu/register/'.$user->register_token, $title = trans('auth.button'), $attributes = array(), $secure = null); !!}
			</span>
		</p>

		<p>{{ trans('auth.troubleshooting') }}</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>