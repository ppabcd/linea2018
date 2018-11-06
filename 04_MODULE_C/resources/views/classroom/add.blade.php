<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
<div class="form-wrapper">
<form action="{{ url('/classroom/add') }}" method="post">
{{csrf_field()}}
	<div>
		<input type="text" name="name" placeholder="Classroom Name">
	</div>
	<div>
		<input type="submit" value="Add" class="button">
	</div>
</form>
@if(request()->error)
    <script>
        alert('{{request()->error}}');
    </script>
@endif
</div>
</body>
</html>