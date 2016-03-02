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
					<td width="30%">
						<img src="{{ URL::asset('img/logo.png') }}" style="width:300px;">
					</td>
					<td width="70%">
						<h2>Teilnahmebestätigung</h2><br>
						<strong>Datum:</strong> <?php echo date('d.m.Y');?><br>
						<strong>Name:</strong> {{ $user->lastname }}, {{ $user->firstname }}<br>
						<strong>Email:</strong> {{ $user->email }}<br>
						<strong>Geburtsdatum:</strong> {{ date(trans('global.dateformat'),$user->birthday) }}
                        
                        <h2>Reservierungsnummer: {{ $raffle->code }}</h2>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" class="outline-table">
			<tbody>
				<tr class="border-bottom border-right grey">
					<td colspan="3"><strong>Zusammenfassung</strong></td>
				</tr>
				<tr class="border-bottom border-right center">
				  @if(($file = $user->files()->where('slug','profile_img')->first()) != null)
					<td width="70%"><strong>{{ $raffle->title }}</strong></td>
					<td width="30%"><strong>Foto</strong></td>
                  @else
                    <td width="100%"><strong>{{ $raffle->title }}</strong></td>
                  @endif
				</tr>
				<tr class="border-right">
				  @if(($file = $user->files()->where('slug','profile_img')->first()) != null)
					<td class="pad-left">{{ $raffle->body }}</td>
					<td class="right-center"><img src="{{ URL::asset($file->path) }}" style="width:200px;"></td>
                  @else
                    <td>{{ $raffle->body }}</td>
                  @endif
				</tr>
			</tbody>
		</table>
		
		<table>
			<tbody>
				<tr>
					<td style="text-align: center; padding-top: 30px;">
						<center>&copy; <?=date("Y");?> Cocobrico Europe Ltd - Alle Rechte vorbehalten.</center>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>