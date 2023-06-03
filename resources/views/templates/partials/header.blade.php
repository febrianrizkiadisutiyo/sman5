<div class="col-sm-6">
    <div class="user-area dropdown float-right">
        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>