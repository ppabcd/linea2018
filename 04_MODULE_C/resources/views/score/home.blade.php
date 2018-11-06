<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('murid')

<div class="table-wrapper">
	<h3>Student List</h3>
	<table border="1">
		<tr>
			<th>Student ID</th>
			<th>Student Name</th>
			<th>Score</th>
			<th>Exam</th>
		</tr>
		@foreach($assess as $student)
		<tr>
			<td>{{\Auth::user()->student->id}}</td>
			<td>{{\Auth::user()->student->name}}</td>
			<td>{{$student->score}}</td>
			<td>
                {{\App\Models\Exams::where(['id'=>$student->id_exam])->first()->title}}
			</td>
		</tr>
		@endforeach
	</table>
</div>
</body>
</html>