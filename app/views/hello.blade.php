<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div class="welcome">
		@if(Session::has('message'))
			<p>{{Session::get('message')}}</p>
		@endif

		@if(empty($user))
			{{HTML::link('/login/fb', 'Login to Facebook')}}
		@else
			<h1>Hello {{$user->name}}</h1>
			<a href="/logout">Logout</a>
			<h3>Your Pages</h3>
				@if(empty($user_pages))
					<h4>No Pages to show</h4>
				@else
				<table>
					<tr>
						<th>Name</th>
						<th>Category</th>
					</tr>
					@foreach($user_pages as $user_pages)
					<tr>
							<td><a href="/page/{{$user_pages->id}}/{{$user->access_token_fb}}">{{$user_pages->name}}</a></td>
							<td>{{ $user_pages->category }}</td>
					</tr>
					@endforeach
				</table>
				@endif
		@endif
	</div>
</body>
</html>