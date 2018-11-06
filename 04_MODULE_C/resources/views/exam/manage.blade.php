<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('guru')
<div class="exam-data">
<div>{{$exams->title}} {{$exams->classroom->name}}</div>
<div>{{date('d M Y H:i:s',strtotime($exams->start))}} - {{date('d M Y H:i:s',strtotime($exams->end))}}</div>
</div>
<div class="multiple-choice-wrapper">
<h3 style="text-align:center">Multiple Choice</h3>
<div class="form-wrapper">
	<form action="{{url('/exam/manage/'.$exams->id.'/multiple')}}" method="POST">
    {{csrf_field()}}
		<div>
			<input type="text" name="question" placeholder="Question">
		</div>

		<div>
			<input type="text" name="option[]" placeholder="optionA">
		</div>
		<div>
			<input type="text" name="option[]" placeholder="optionB">
		</div>
		<div>
			<input type="text" name="option[]" placeholder="optionC">
		</div>
		<div>
			<input type="text" name="option[]" placeholder="optionD">
		</div>
		<div>
			<input type="text" name="option[]" placeholder="optionE">
		</div>
		<div>
			<input type="number" name="weight" placeholder="Score Weight">
		</div>

		<div>
			<select name="correct_answer_id">
				<option selected>--Select Correct Choice--</option>
				<option value="0">A</option>
				<option value="1">B</option>
				<option value="2">C</option>
				<option value="3">D</option>
				<option value="4">E</option>
			</select>
		</div>
		<div>
			<input type="submit" value="Insert Question" class="button">
		</div>
	</form>
</div>
<div>
	<div class="multiple-choice">
        @foreach($multiple as $single)
		<div class="question">
			{{$single->question}}
			<span class="weight">
				(Weight: {{$single->weight}}%)
			</span>
			<span class="button"><a href="{{url('/exam/manage/'.$exams->id.'/multiple/'.$single->id.'/delete')}}">Delete</a></span>
			<div class="answer">
				<table>
                    @php
                        $arr = ['A','B','C','D','E'];
                        $i = 0;
                        $s = 0;
                    @endphp
                        <tr>
                        @foreach($single->option as $opt)
                            <td 
                                @if($opt->id == $single->correct_answer_id)
                                    class="correct-answer"
                                @endif
                            >{{$arr[$i]}}. {{$opt->text}}</td>
                            @php
                                $i++;
                                $s++;
                            @endphp
                            @if($s == 2)
                                </tr><tr>
                                @php
                                    $s = 0;
                                @endphp
                            @endif
                        @endforeach
                        </tr>
				</table>
			</div>
		</div>
        @endforeach
	</div>
</div>
</div>

<div class="essay-wrapper">
<h3 style="text-align:center">Essay</h3>
<div class="form-wrapper">
	<form action="{{url('/exam/manage/'.$exams->id.'/essay')}}" method="POST">
    {{csrf_field()}}
		<div>
			<input type="text" name="question" placeholder="Question">
		</div>
		<div>
			<input type="text" name="keywords" placeholder="Keywords">
		</div>
		<div>
			<input type="number" name="weight" placeholder="Score Weight">
		</div>
		<div>
			<input type="submit" value="Insert Question" class="button">
		</div>
	</form>
</div>
<div>
	<div class="essay">
        @foreach($essay as $es)
		<div class="question">
			{{$es->question}}
			<span class="weight">
				(Weight: {{$es->weight}}%) 
			</span>
			<span class="keywords">
				Keyword: 
                @foreach($es->keywords as $key)
                    {{$key->text}},
                @endforeach
			</span>
			<span class="button"><a href="{{url('/exam/manage/'.$exams->id.'/essay/'.$es->id.'/delete')}}">Delete</a></span>
		</div>
        @endforeach
	</div>
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