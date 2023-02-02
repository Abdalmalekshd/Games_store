<nav role='navigation'>

    <ul class="main">
        <li class="dashboard"><a href="{{ asset('games/Dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('messages.main page') }}</a></li>
        <li class="dashboard"><a href="{{ asset('games/AddGame') }}"><i class="fa fa-Add"></i>{{ __('messages.Add Game') }}</a></li>
        <li class="edit"><a href="{{ asset('games/AllGames') }}"><i class="fa fa-gamepad"></i>{{ __('messages.AllGames') }}</a></li>
        <li class="users"><a href="{{ asset('games/Suggestions') }}"><i class="fa fa-comment"></i>{{ __('messages.Suggestions') }}</a></li>
    </ul>
</nav>
