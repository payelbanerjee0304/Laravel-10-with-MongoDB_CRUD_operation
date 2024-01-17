<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form method="post" action="{{url('/save')}}" enctype="multipart/form-data">
			@csrf
			@if(session('message'))
			<div class="alert alert-danger">{{session('message')}}</div>
			@endif
			<header class="modal-header alert alert-primary"><h1>Login Page</h1></header>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
				<input type="reset" name="reset" value="Reset" class="btn btn-danger btn-lg">
			</div>
			<div>
				<label>New Registration->></label>
				<a href="{{url('insert')}}" class="btn btn-primary">Click here</a>
			</div>
		</form>
	</div>
</body>
</html>