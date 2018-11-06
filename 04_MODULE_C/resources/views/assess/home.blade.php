<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('guru')

<div class="table-wrapper">
	<h3>Assess Exam</h3>
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
			<td>{{date("d M Y H:i:s",strtotime($exam->start))}}</td>
			<td>{{date("d M Y H:i:s",strtotime($exam->end))}}</td>
			<td>
				<a href="
				@if(date('Y-m-d H:i:s',strtotime($exam->end)) < date('Y-m-d H:i:s'))
                    {{url('/assess/'.$exam->id)}}
                @endif
				" class="button
                @if(date('Y-m-d H:i:s',strtotime($exam->end)) > date('Y-m-d H:i:s'))
                    disabled
                @endif
                " time = "{{date('Y-m-d H:i:s',strtotime($exam->end))}}"
                >Assess</a>
			</td>
		</tr>
        @endforeach
		<tr>
			<td>UTS Matematika</td>
			<td>10B</td>
			<td>11 Agustus 2017 13:00:00</td>
			<td>11 Agustus 2017 15:00:00</td>
			<td>
				<a href="" class="button disabled">Assess</a>
			</td>
		</tr>
	</table>
</div>
</body>
</html>