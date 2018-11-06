<nav>
	<span>
		<a href="{{url('/answer')}}">Answer Exam</a>
		<a href="{{url('/score')}}">View Score</a>
		<a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Logout
        </a>

	</span>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</nav>