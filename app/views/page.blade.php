<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div>
		@if($page_insight)
			<a href="/">Back To Pages</a>
			@foreach($page_insight as $key => $value)
				<h4>Title: <span>{{$value->title}}</span></h4>
				<h5>Description: <span>{{$value->description}}</span></h5>
					<?php 
						$array = json_decode(json_encode($value->values), True);
						for ($i=0; $i < count($array); $i++) { 
							$innerArray = json_decode(json_encode($array[$i]), True);
							foreach ($innerArray as $key => $value) {
								$value1 = serialize($value);
								print "$key = $value1<br>";
								print "<br>";
							}
						}
					?>
			@endforeach
		@else
			<h4>Page Insights Unavailable</h4>
			<a href="/">Back To Pages</a>
		@endif
	</div>
</body>
</html>