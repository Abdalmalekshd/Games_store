<header role="banner">
    <h1><i class="fa fa-gamepad"></i>{{ __('messages.Games_str') }}</h1>
    {{-- <select class="lang" > --}}
        <ul class="lang_ul">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                {{-- <option> --}}
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        {{-- </option> --}}
        @endforeach
    </ul>
    {{-- </select> --}}
    <?php
    if (!isset($NoSerachText)) {
        ?>
    <form action="{{ route('adminserach') }}" method="GET">
    
        <input type="serach" class="serach" placeholder="{{ __('messages.Serach') }}" @if (LaravelLocalization::getCurrentLocale() == 'ar')
        style="direction: rtl;"
        
        @else
        style="direction: ltr;"
        
        @endif>
    
</form>
<?php
}
    ?>
    <ul class="utilities">

        {{-- <li class="users"><a href="{{ route('AdminAcc') }}">{{ __('messages.my acc') }}</a></li> --}}
        <li class="logout warn"><a href="{{ route('Logout') }}">{{ __('messages.sign out') }}</a></li>

    </ul>
</header>
