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
<div>{{$student->id}} / {{$student->name}}</div>
</div>

<div class="multiple-choice-wrapper">
<h3 style="text-align:center">Multiple Choice</h3>
<div>
	<div class="multiple-choice">
    @php
    $score_pg = 0;
    $total_pg = 0;
    @endphp
    @foreach($multiple as $single)
		<div class="question">
			{{$single->question}}
			<span class="weight">
				(Weight: {{$single->weight}}%)
                @php
                    $total_pg = $total_pg + $single->weight;
                @endphp
			</span>
			<div class="answer">
				<table>
                    @php
                        $arr = ['A','B','C','D','E'];
                        $i = 0;
                        $s = 0;
                        $sql = \App\Models\StudentMultipleChoiceAnswers::where(['question_id'=>$single->id])->first();
                    @endphp
                        <tr>
                        @foreach($single->option as $opt)
                            <td class="
                                @if($opt->id == $single->correct_answer_id)
                                    correct-answer
                                    @if($opt->id == $sql->option_id)
                                        choosen-answer
                                        @php
                                            $score_pg= $score_pg+$single->weight;
                                        @endphp
                                    @endif
                                @else
                                    @if($opt->id == $sql->option_id)
                                        choosen-answer
                                    @endif
                                @endif
                                "
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
<div>
	Total score from multiple choice: {{$score_pg}}
</div>
</div>

<form method="post" action="{{url('/assess/'.$exam->id.'/'.$student->id)}}">
{{csrf_field()}}
<div class="essay-wrapper">
<h3 style="text-align:center">Essay</h3>
<div>
	<div class="essay">
    @foreach($essay as $es)

        @php
            $sql = \App\Models\StudentEssayAnswers::where(['essay_question_id'=>$es->id])->first();
        @endphp
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
            <div style="margin-top:20px;">
                Jawaban : {{$sql->answer}}
            </div>
		</div>
    @endforeach
	<input type="number" name="sum_essay" placeholder="Score Essay 1">
    <span>Score tidak boleh melebihi : {{$exam->sumdata['sum']-$total_pg}}</span>
    <input type="hidden" name="limit" value="{{$exam->sumdata['sum']-$total_pg}}">
    <input type="hidden" name="sum_pg" value="{{$score_pg}}">
</div>


<div style="margin-top:5%;text-align:center">
<input class="button" type="submit" value="Submit All Score">
</div>
<script>
    @if(request()->error)
        alert('{{request()->error}}')
    @endif
</script>
</form>
</body>
</html>