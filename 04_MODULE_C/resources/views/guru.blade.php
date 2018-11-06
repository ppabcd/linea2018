<nav>
	<span>
		<a href="{{url('/exam')}}">Create Exam</a>
		<a href="{{url('/assess')}}">Assess Exam</a>
		<a href="">Statistic</a>
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