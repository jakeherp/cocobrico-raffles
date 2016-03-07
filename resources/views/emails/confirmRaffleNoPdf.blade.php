<body style="background: #000;">
	<img src="{{ URL::asset('img/logo_black.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>Hallo {{ $user->firstname }},</p>

		<p>Dein Interesse an unserer Aktion {{ $raffle->title }} ist registriert. Du kriegst Bescheid, wenn's klappt.<br>
		Falls Du einen Freischaltcode erhalten hast, gib diesen auf der Webseite ein und du erhältst Umgehend eine Bestätigung im PDF Format.<br><br>

		Viel Glück,<br>
		Dein Cocobrico Team</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>