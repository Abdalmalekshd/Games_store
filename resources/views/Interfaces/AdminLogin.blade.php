<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>



    <link rel="stylesheet" href="{{ asset('Login.css') }}">
    <title>Login</title>
</head>

<body>
    <div class="login-box">
        <h2>{{ __('messages.log') }}</h2>
        <form action="{{ route('AdminSignin') }}" method="POST">
            @csrf
            <div class="user-box">
                <input type="email" name="email" required>
                <label>{{ __('messages.email') }}</label>
            </div>


            <div class="user-box">
                <input type="password" name="password" required="">
                <label>{{ __('messages.pass') }}</label>
            </div>


            
            <button class="login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                {{ __('messages.log') }}
            </button>

            @if (Session::has('error'))
                <div id="invalidCheck3Feedback" class="alert alert-danger msg">
                    {{ Session::get('error') }}
                </div>
            @endif
        </form>
    </div>
</body>

</html>
