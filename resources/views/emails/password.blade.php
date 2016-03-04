<body style="background: #000;">
	<img src="{{ URL::asset('img/logo.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>Hallo {{ $user->firstname }},</p>
		<p>Klicke bitte auf den folgenden Link, um dein Passwort bei Cocobrico zurückzusetzen:</p>

		<p style="text-align: center; margin: 30px 0;">
			<span style="border: 2px solid #ee1d23; padding: 10px; color: #ee1d23; font-size: 1.25em;">
				{!! link_to('http://cocobrico.info/password/'.$user->register_token, $title = 'Zurücksetzen', $attributes = array(), $secure = null); !!}
			</span>
		</p>

		<p>Mit freundlichen Grüßen,<br>Dein Cocobrico Team</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>