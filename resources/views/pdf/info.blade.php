<html>
<head>
<title>Teilnahmebestätigung</title>
<style type="text/css">
	body{
		background: #fff;
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	#page-wrap {
		width: 700px;
		margin: 0 auto;
	}
	.center-justified {
		text-align: justify;
		margin: 0 auto;
		width: 30em;
	}
	table.outline-table {
		border: 1px solid;
		border-spacing: 0;
	}
	td{
		vertical-align: top;
	}
	tr.border-bottom td, td.border-bottom {
		border-bottom: 1px solid;
	}
	tr.border-top td, td.border-top {
		border-top: 1px solid;
	}
	tr.border-right td, td.border-right {
		border-right: 1px solid;
	}
	tr.border-right td:last-child {
		border-right: 0px;
	}
	tr.center td, td.center {
		text-align: center;
		vertical-align: text-top;
	}
	td.pad-left {
		padding-left: 5px;
	}
	tr.right-center td, td.right-center {
		text-align: right;
		padding-right: 50px;
	}
	tr.right td, td.right {
		text-align: right;
	}
	.grey {
		background:grey;
	}
</style>
</head>
<body>
	<div id="page-wrap">
		<table width="100%">
			<tbody>
				<tr>
					<td width="70%">
						<img src="{{ URL::asset('img/logo.png') }}" style="width:300px;background:#000;padding:10px">

						<h2>Bestätigung</h2><br>

                        <strong>Reservierungsnummer:</strong> 
                        @if(isset($preview))
                        	PREVIEW<br><br>
                        @else
                        	{{ $user->raffles()->where('raffle_id', $raffle->id)->first()->pivot->code }}<br><br>
                        @endif
						<strong>Datum:</strong> <?php echo date('d.m.Y');?><br>
						<strong>Name:</strong> {{ $user->lastname }}, {{ $user->firstname }}<br>
						<strong>Email:</strong> {{ $user->email }}<br>
						<strong>Geburtsdatum:</strong> {{ date(trans('global.dateformat'),$user->birthday) }}<br>
						<strong>Mitglied seit:</strong> {{ date(trans('global.dateformat'),strtotime($user->created_at)) }}
                        
					</td>
					<td width="30%">
						<img src="{{ URL::asset('files/user_'.$user->id.'/qrcode.png') }}" style="width:150px; float: right;"><br>
				  	  @if(($file = $user->files()->where('slug','profile_img')->first()) != null)
						<img src="{{ URL::asset($file->path) }}" style="max-width:150px;max-height:180px;margin-top:10px;float:right;">
				  	  @endif
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<h3>{{ $raffle->title }}</h3>
		<p>{!! $raffle->body !!}</p>

		<p>&nbsp;</p>

		<?php
        	$file = $raffle->files()->where('slug','raffle_img')->first();
        ?>

        @if($file != null)
        	<img src="{{ URL::asset($file->path) }}" style="width: 700px; height:400px;">
        @endif
	</div>
</body>
</html>