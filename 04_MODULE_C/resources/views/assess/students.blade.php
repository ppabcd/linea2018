<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('guru')

<div class="exam-data">
<div>{{$exam->title}} {{$exam->classroom->name}}</div>
<div>{{date('d M Y H:i:s',strtotime($exam->start))}} - {{date('d M Y H:i:s',strtotime($exam->end))}}</div>
</div>

<div class="table-wrapper">
	<h3>Student List</h3>
	<table border="1">
		@php	
			$sql = \App\Models\Students::where(['classroom_id'=>$exam->classroom_id])->get();
		@endphp
		<tr>
			<th>Student ID</th>
			<th>Student Name</th>
			<th>Score</th>
			<th>Action</th>
		</tr>
		@foreach($sql as $student)
		<tr>
			<td>{{$student->id}}</td>
			<td>{{$student->name}}</td>
			<td>{{
				(\App\Models\Assess::where(['id_exam'=>$exam->id,'id_student'=>$student->id])->first())
				?
				\App\Models\Assess::where(['id_exam'=>$exam->id,'id_student'=>$student->id])->first()->score
				: ''
				
				}}</td>
			<td>
				<a href="{{url('assess/'.$exam->id.'/'.$student->id)}}" class="button">Assess</a>
			</td>
		</tr>
		@endforeach
	</table>
</div>
</body>
</html>