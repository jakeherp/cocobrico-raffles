<body style="background: #000;">
	<img src="{{ URL::asset('img/logo.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>Hallo,</p>
		<p>Bitte bestätige deine Email-Adresse, um die Registrierung deines Benutzerkontos fortzusetzen:</p>

		<p style="text-align: center; margin: 30px 0;">
			<span style="border: 2px solid #ee1d23; padding: 10px; color: #ee1d23; font-size: 1.25em;">
				{!! link_to('http://gewinnspiel.cb.pcserve.eu/register/'.$user->register_token, $title = 'Bestätigen', $attributes = array(), $secure = null); !!}
			</span>
		</p>

		<p>Falls du Probleme bei der Aktivierung hast, kannst du dich jederzeit an info@cocobrico.com wenden. Wir helfen dir gern weiter.</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>