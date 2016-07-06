<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div>
		<a href="/back/page/{{$fbtoken}}">Back To Pages</a>
		@foreach($page_insight as $key => $value)
			<h4>Title: <span>{{$value->title}}</span></h4>
			<h5>Description: <span>{{$value->description}}</span></h5>
				<?php 
					$array = json_decode(json_encode($value->values), True);
					// var_dump($array);
					for ($i=0; $i < count($array); $i++) { 
						$innerArray = json_decode(json_encode($array[$i]), True);
						var_dump($innerArray);
					}
				?>

		@endforeach
	</div>
</body>
</html>