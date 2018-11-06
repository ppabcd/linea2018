<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('murid')
<div class="table-wrapper">
	<h3>Manage Exam Question</h3>
	<table border="1">
		<tr>
			<th>Title</th>
			<th>Clasroom</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Action</th>
		</tr>
		@foreach($exams as $exam)
		<tr>
			<td>{{$exam->title}}</td>
			<td>{{$exam->classroom->name}}</td>
			<td>{{date('d M Y H:i:s',strtotime($exam->start))}}</td>
			<td>{{date('d M Y H:i:s',strtotime($exam->end))}}</td>
			<td>
				<a href="{{url('/answer/'.$exam->id)}}" class="button">Answer</a>
			</td>
		</tr>
		@endforeach
	</table>
</div>
<script>
	@if($errors)
		@foreach($errors->all() as $error)
			alert("{{$error}}");
		@endforeach
	@endif
</script>
<script>
    @if(request()->success)
        alert("Successfuly added.");
    @endif
</script>
</body>
</html>