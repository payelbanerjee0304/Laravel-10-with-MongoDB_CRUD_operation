<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<form method="post" action="{{url('/submit')}}" enctype="multipart/form-data">
			@csrf
			@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(session('message'))
			<div class="alert alert-danger">{{session('message')}}</div>
			@endif
			<header class="modal-header alert alert-primary"><h1>Registration</h1></header>
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label>Phone</label>
				<input type="number" name="phone" class="form-control">
			</div>
			<div class="form-group">
				<label>Gender</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Male">Male
				</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Female">Female
				</label>
				<label class="btn btn-secondary">
				<input type="radio" name="gender" autocomplete="off" value="Others">Others
				</label>
			</div>
			<div class="form-group">
				<label>Language</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off" value="English">English
				</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off" value="Hindi">Hindi
				</label>
				<label class="btn btn-primary">
				<input type="checkbox" name="language[]" autocomplete="off" value="Bengali">Bengali
				</label>
			</div>
			<div class="form-group">
				<label>Profile Picture</label>
				<input type="file" name="file" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
				<input type="reset" name="reset" value="Reset" class="btn btn-danger btn-lg">
			</div>
		</form>
	</div>
</body>
</html>