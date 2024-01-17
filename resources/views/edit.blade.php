<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	@if(isset($userinfo))
	<div class="container">
		<form method="post" action="{{url('/update')}}" enctype="multipart/form-data">
			@csrf
			@if(session('message'))
			<div class="alert alert-danger">{{session('message')}}</div>
			@endif
			<header class="modal-header alert alert-primary"><h1>Edit Page</h1></header>
			<input type="text" name="uid" value="{{$userinfo['_id']}}" >
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{$userinfo['name']}}">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" value="{{$userinfo['email']}}">
			</div>
			<div class="form-group">
				<label>Phone</label>
				<input type="number" name="phone" class="form-control" value="{{$userinfo['phone']}}">
			</div>
			<div class="form-group">
				<label>Gender</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Male"@if($userinfo['gender']=="Male") checked @endif>Male
				</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Female"@if($userinfo['gender']=="Female") checked @endif>Female
				</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Others"@if($userinfo['gender']=="Others") checked @endif>Others
				</label>
			</div>
			@php
			$language=explode(', ', $userinfo['language']);
			@endphp
			<div class="form-group">
				<label>Language</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off" value="English"@if(in_array('English', $language)) checked @endif>English
				</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off"  value="Hindi"@if(in_array('Hindi', $language)) checked @endif>Hindi
				</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off" value="Bengali"@if(in_array('Bengali', $language)) checked @endif>Bengali
				</label>
			</div>
			<div class="form-group">
				<label>Profile Picture</label>
				<input type="file" name="file" class="form-control"><img src="{{$userinfo['image']}}" height="100">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Update" class="btn btn-success btn-lg">
			</div>
		</form>
	</div>
	@endif
</body>
</html>