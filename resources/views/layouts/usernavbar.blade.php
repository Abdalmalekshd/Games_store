<nav role='navigation'>
    <ul class="main">
        <li class="home"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ __('messages.main page') }}</a></li>
        <li class="horror"><a href="{{ route('HorrorCate') }}"><i class="fa fa-warning"></i>{{ __('messages.horror') }}</a></li>
        <li class="Action"><a href="{{ route('ActionCate') }}">{{ __('messages.Action') }}</a></li>
        <li class="Adventure"><a href="{{ route('AdventureCate') }}">{{ __('messages.Adventure') }}</a></li>
        <li class="Survival"><a href="{{ route('SurvivalCate') }}">{{ __('messages.Survival') }}</a></li>
        {{-- <li class=""><a href=""><i class="fa fa-comment"></i>{{ __('messages.MySuggestions') }}</a></li> --}}
        <li class="About"><a href="{{ route('About') }}"><i class="fa fa-"></i>{{ __('messages.About') }}</a></li>
        </ul>
</nav>
