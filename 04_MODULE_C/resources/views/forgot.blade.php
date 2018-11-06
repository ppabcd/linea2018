<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
{{ $errors->first('email') }}
<div class="form-wrapper">
<form action="{{ route('forgot') }}" method="post">
{{csrf_field()}}
	<div>
		<input type="password" name="password_old" placeholder="Password Lama">
	</div>
    <div>
		<input type="password" name="password" placeholder="Password Baru">
	</div>
    <div>
		<input type="password" name="password_confirm" placeholder="Password Baru Konfirmasi">
	</div>
	<div>
		<input type="submit" value="Login" class="button">
	</div>
</form>
</div>
</body>
</html>