<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@if(Auth::user()->student_id)
	@include('murid')

@else
	@include('guru')
@endif
<div class="form-wrapper">
	<form action="{{url('/forgot')}}" method="POST">
		{{csrf_field()}}
		<div>
			<input type="password" name="old_password" placeholder="Old Password">
		</div>
		<div>
			<input type="password" name="password" placeholder="New Password">
		</div>
		<div>
			<input type="password" name="password_confirmation" placeholder="New Password (Confirmation)">
		</div>
		<div>
			<input type="submit" value="Change Password" class="button">
		</div>
	</form>
</div>
<script>
	@if($errors)
		@foreach($errors->all() as $error)
			alert("{{$error}}");
		@endforeach
	@endif
</script>
</body>
</html>