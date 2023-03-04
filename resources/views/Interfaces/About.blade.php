@extends('layouts.UserMaster')

<link rel="stylesheet" href="{{ asset('user.css') }}">

@section('Title', 'About')
<?php
$NoSerachText = '';
?>
@section('content')

        <div class="about">
    <h1>{{ __('messages.About') }}</h1>

            <blockquote>
            <p> WebSite is For Gamers,You As A Gamer You Can Serach & Download Games,Also You Can Comment & Rate Games,Also You'll Get An Email When A New Game Is Added.</p>
        <p>This WebSite Is Bulding In laravel FrameWork & It's Bulding With 2 Languages.</p>
        <p>As An Admin You Can Manage Games <span>( Add A New Game , Delete Game , Update Game ) </span>,You Can Also See The Stats Of This WebSite <span>( Number Of Games You Have Added In The WebSite , Number Of Users In Your WebSite, Number Of Visiters )</span> ,Also You Can Manage Users & Users Comments.</p>

</blockquote>

    </div>

    @endsection