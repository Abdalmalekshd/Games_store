<html>
{{-- @if (LaravelLocalization::getCurrentLocale() == 'ar')
style="direction: rtl;"

@else
style="direction: ltr;"

@endif --}} {{--  مشان يقلب الموقع عحسب اللغة htmlبتنحط جوا وسم ال ifهي ال  --}}


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google" value="notranslate" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css.map') }}">
    <script src="https://kit.fontawesome.com/f304de03af.js" crossorigin="anonymous"></script>
  
    <?php
    if (!isset($ChangeCssFile)) {
        ?>
        <link rel="stylesheet" href="{{ asset('admin.css') }}">
        <?php
    }else{
        ?>
    <link rel="stylesheet" href="{{ asset('login.css') }}">
        <?php
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Title', 'Games_store')</title>


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    




</head>

<body>

    {{-- @include('layout.header') --}}
    <div class="content">

        @include('layouts.header')

        <div>
            @include('layouts.navbar')
        </div>
        <div class="container">

            @yield('content')

        </div>

    </div>



</body>

</html>
