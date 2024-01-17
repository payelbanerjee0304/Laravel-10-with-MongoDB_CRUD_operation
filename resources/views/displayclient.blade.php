<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Display Client</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	@if(isset($clientinfo))
	<div class="table-responsiv">
		@foreach($clientinfo->all() as $all)
		<table border="1" cellpadding="20" cellspacing="0" class="table table-hover table-border">
			<h2>Welcome {{$all['name']}}</h2>
			<tr>
				<th>SL.No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>Language</th>
				<th>Profile Picture</th>
				<th>Action</th>
			</tr>
			@php 
			$i=1;
			@endphp
			<tr>
				<td>@php echo $i; $i++; @endphp</td>
				<td>{{$all['name']}}</td>
				<td>{{$all['email']}}</td>
				<td>{{$all['password']}}</td>
				<td>{{$all['phone']}}</td>
				<td>{{$all['gender']}}</td>
				<td>{{$all['language']}}</td>
				<td><img src="{{$all['image']}}" height="100"></td>
				<td><a href="{{url('/edit')}}{{$all['_id']}}">Edit</a> || 
					<a href="{{url('/changepassword')}}{{$all['_id']}}">Change Password</a> || 
					<a href="{{url('/logout')}}">Logout</a></td>
			</tr>
			@endforeach
		</table>
	</div>
	@endif
</body>
</html>