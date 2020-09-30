<html>
<head>
	<title>Report</title>
	<link rel="stylesheet" href="static/styles.css">
</head>
<body>
	@foreach($queries as $key => $value)
		<h1>{{ $key }}</h1>
		{!! $utils->asTable($value) !!}
	@endforeach
</body>
</html>