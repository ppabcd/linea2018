
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('guru')

<div class="form-wrapper">
	<form action="{{url('/exam/add')}}" method="POST">
	{{csrf_field()}}
		<div>
			<input type="text" name="title" placeholder="Exam Title">
		</div>

		<div>
			<select name="classroom_id">
				<!-- get options from database -->
				<option selected>--Select Classroom--</option>
				@foreach($class as $c)
				<option value="{{$c->id}}">{{$c->name}}</option>
				@endforeach
			</select>
		</div>
		<div>
			<div class="input-title">Start Exam Time</div>
			<input type="date" name="start_date">
			<input type="time" name="start_time">
		</div>
		<div>
			<div class="input-title">End Exam Time</div>
			<input type="date" name="end_date">
			<input type="time" name="end_time">
		</div>
		<div>
			<input type="submit" value="Create New Exam" class="button">
		</div>
	</form>
</div>
<div class="table-wrapper">
	<h3>Manage Exam Question</h3>
	<table border="1">
		<tr>
			<th>Title</th>
			<th>Classroom</th>
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
				<a href="{{url('/exam/manage/'.$exam->id)}}" class="button">Manage Question</a>
				<a href="{{url('/exam/delete/'.$exam->id)}}" class="button">Delete</a>
			</td>
		</tr>
		@endforeach
	</table>
</div>
</body>
</html>