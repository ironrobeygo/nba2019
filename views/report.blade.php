<html>
<head>
	<title>Report</title>
	<link rel="stylesheet" href="static/styles.css">
</head>
<body>
	@foreach($queries as $key => $value)
		<h2>{{ $key }}</h2>
		{!! $utils->asTable($value) !!}
	@endforeach
</body>
</html>