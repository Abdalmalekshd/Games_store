<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <title>Signup</title>

</head>

<body>
    <div class="login-box">
        <h2>{{ __('messages.sign in') }}</h2>
        <form action="{{ route('Createaccount') }}" method="POST">
            @CSRF
            <div class="user-box">
                <input type="text" name="full_name" >
                <label>{{ __('messages.name') }}</label>
                @error('full_name')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>

            <div class="user-box">
                <input type="email" name="email" >
                <label>{{ __('messages.email') }}</label>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>
            <div class="user-box">
                <input type="text" name="user_name" >
                <label>{{ __('messages.user_name') }}</label>
                @error('user_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="password" name="password" >
                <label>{{ __('messages.pass') }}</label>
                @error('password')
                <div class="alert alert-danger message">{{ $message }}</div>
                @enderror
            </div>

            <button style="margin-left:90px" class="login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                {{ __('messages.sign in') }}
            </button>
        </form>
</body>

</html>
