<h1>Dashboard Lecturer</h1>
<div>
    <a href="{{ route('logout') }}" class="nav-link" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            logout
    </a>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>