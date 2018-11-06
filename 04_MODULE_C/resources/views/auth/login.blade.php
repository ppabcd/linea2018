<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
{{ $errors->first('email') }}
<div class="form-wrapper">
<form action="{{ route('login') }}" method="post">
{{csrf_field()}}
	<div>
		<input type="text" name="email" placeholder="Email">
	</div>
	<div>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div>
		<input type="submit" value="Login" class="button">
	</div>
</form>
</div>
</body>
</html>