<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/style.css">
</head>
<body>
@include('murid')

<div class="exam-data">
<div>UTS Matematika kelas 10A</div>
<div>10 Agustus 2017 09:00:00 - 10 Agustus 2017 11:00:00</div>
</div>

<form method="post" action="{{url('/answer/'.$exams->id)}}">
{{csrf_field()}}

<div class="multiple-choice-wrapper">
<h3 style="text-align:center">Multiple Choice</h3>
<div>
	<div class="multiple-choice">
        @foreach($exams->multiple as $multiple)
		<div class="question">
			{{$multiple->question}}
			<span class="weight">
				(Weight: {{$multiple->weight}}%) 
			</span>
			<div class="answer">
            <table>
                    @php
                        $i = 0;
                        $s = 0;
                    @endphp
                        <tr>
                        @foreach($multiple->option as $opt)
                            <td><input type="radio" name="s-{{$multiple->id}}" value="j{{$opt->id}}"> {{$opt->text}}</td>
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
<div>
	<div class="essay">
    @foreach($exams->essay as $essay)
		<div class="question">
			{{$essay->question}}
			<span class="weight">
				(Weight: {{$essay->weight}}%) 
			</span>
		</div>
		<div class="answer">
			<textarea name="essay-{{$essay->id}}">
			</textarea>
		</div>
    @endforeach
	</div>
</div>

<div style="margin-top:5%;text-align:center">
<input type="submit" value="Submit Answers" class="button">
</div>

</form>
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