<body style="background: #000;">
	<img src="{{ URL::asset('img/logo_black.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>Hallo {{ $user->firstname }},</p>
		<p>Vielen Dank für deine Anmeldung zu unserer Aktion {{ $raffle->title }}. Anbei findest du deine Bestätigung als PDF. Diese solltest du ausgedruckt mitbringen, um eventuelle Gewinne einlösen zu können.</p>
		<p><a href="http://www.cocobrico.info/">Hier geht's zurück zum Cocobrico Kundenportal</a></p>
		<p>Viel Glück,<br>Dein Cocobrico Team</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>