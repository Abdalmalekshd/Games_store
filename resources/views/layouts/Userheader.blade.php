<header role="banner">
    <h1>{{ __('messages.Games_str') }}</h1>


        <ul class="lang_ul">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>

                    <a rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>

        @endforeach
    </ul>
    <form action="{{ route('serach') }}" method="GET">

    <?php
    if (!isset($NoSerachText)) {
        ?>
        <input type="serach" class="serach" placeholder="{{ __('messages.Serach') }}" name='serach'
        @if (LaravelLocalization::getCurrentLocale() == 'ar')
style="direction: rtl;"

@else
style="direction: ltr;"

@endif >
        <?php
    }?>
</form>




    <ul class="utilities">

        <li class="users"><a href="{{ route('Acc') }}">{{ __('messages.my acc') }}</a></li>
        <li class="logout warn"><a href="{{ route('Logout') }}">{{ __('messages.sign out') }}</a></li>

    </ul>
</header>
