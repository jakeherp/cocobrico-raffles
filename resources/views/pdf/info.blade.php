<html>
<head>
<title>{{ $confirmation->title }}</title>
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
	img.logo{
		width:300px;
		background:#000;
		padding:10px
	}
	img.qr-code{
		width:150px;
		float: right;
	}
	img.photo{
		max-width:150px;
		max-height:180px;
		margin-top:10px;
		float:right;
	}
	img.post-photo{
		width: 700px;
		height:400px;
	}
</style>
</head>
<body>
	<div id="page-wrap">
		{!! $confirmation->body !!}
	</div>
</body>
</html>