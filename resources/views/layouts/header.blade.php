<header role="banner">
    <h1>{{ __('messages.Games_str') }}</h1>
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
    <form action="" method="">
    <?php
    if (!isset($NoSerachText)) {
        ?>
        <input type="serach" class="serach" placeholder="{{ __('messages.Serach') }}">;
        <?php
    }
    ?>
</form>
    <ul class="utilities">

        {{-- <li class="users"><a href="{{ route('AdminAcc') }}">{{ __('messages.my acc') }}</a></li> --}}
        <li class="logout warn"><a href="{{ route('Logout') }}">{{ __('messages.sign out') }}</a></li>

    </ul>
</header>
