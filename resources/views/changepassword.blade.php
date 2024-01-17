<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	@if(isset($passinfo))
	<div class="container">
		<form method="post" action="{{url('/changepasswordaction')}}">
			@csrf
			<header class="modal-header alert alert-primary"><h1>Password change page</h1></header>
			<input type="text" name="uid" value="{{$passinfo['_id']}}">
			<div class="form-group">
				<label>Old Password</label>
				<input type="password" name="oldp" class="form-control">
			</div>
			<div class="form-group">
				<label>New Password</label>
				<input type="password" name="newp" class="form-control">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="confp" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
				<input type="reset" name="reset" value="Reset" class="btn btn-danger btn-lg">
			</div>
		</form>
	</div>
	@endif
</body>
</html>