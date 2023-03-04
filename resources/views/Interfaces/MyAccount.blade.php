@extends('layouts.usermaster')

<link rel="stylesheet" href="{{ asset('user.css') }}">
<link rel="stylesheet" href="{{ asset('Login.css') }}">


@section('Title', 'My Account')
<?php
$ChangeCssFile = '';
?>
@section('content')
<main role="main">

    <div class="login-box" style="margin-top: 20px">
        <h2>{{ __('messages.my acc') }}</h2>
        <form action="{{ route('UpdateAcc') }}" method="POST">
            @CSRF
            <div class="user-box">



                <input type="text" name="full_name"  value="{{ $user->name }}" placeholder="Name">

            </div>

            <div class="user-box">
                <input type="email" name="email" value="{{ $user->email }}" placeholder="Email">

            </div>
            <div class="user-box">
                <input type="text" name="user_name" value="{{ $user->user_name }}"  placeholder="Username">

            </div>
            <div class="user-box">
                <input type="password" name="password" placeholder="password">


            </div>

            <button style="margin-left:90px" class="login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                {{ __('messages.Update') }}
            </button>

            @if (Session::has('success'))
            <div class="alert alert-success text-center" style="color:Red;margin-top:10px">{{ Session::get('success') }}</div>
        @endif

        </form>
@endsection
