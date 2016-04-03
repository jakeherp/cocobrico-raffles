<body style="background: #000;">
	<img src="{{ URL::asset('img/logo_black.png') }}" alt="{{ trans('global.cocobrico') }}" style="width: 90%; max-width: 300px; display: block; margin: 30px auto;">
	<div style="background: #fff; color: #000; padding: 20px; width: 90%; margin: 20px auto;">
		<p>Hallo {{ $member->firstname }},</p>
		<p>Du hast eine neue Nachricht auf <a href="http://www.cocobrico.info">Cocobrico</a>.</p>
		<p>Mit freundlichen Grüßen,<br>Dein Cocobrico Team</p>
	</div>
	<div style="text-align: center; color: #fff;">&copy; <?=date("Y");?> {{ trans('global.company') }}</div>
</body>