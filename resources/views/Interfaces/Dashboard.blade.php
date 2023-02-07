@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'Dashboard')

<?php
$NoSerachText = '';
?>
@section('content')
<div class="stat">
    <div class="row">
<div class="gamesnum col-md-3">
    <label for="">Number Of Games</label>
<span><a href="{{ route('AllGames') }}">{{  $countGames }}</a></span>
</div>


<div class="users col-md-3">
    <label for="">Number Of Users</label>

    <span><a href="">{{ $countUsers }}</a></span>
</div>



<div class="visiters_per_Day col-md-3">
    <label for="">Visiters For That Today</label>

    <span>200</span>
</div>

<div class="visiters_per_Year col-md-3">
    <label for="">Visiters For This Year</label>

    <span>10000</span>
</div>
</div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center headerforusers">
        <p><i class="fa fa-users"></i>Users</p>
        </div>
        <div class="panel-body forusers">
            @foreach ($user as $user)
        {{ $user->name }}
        <a href="{{ route('DltUser', $user->id) }}"class="btn btn-danger delcomment"><i class='fa fa-close'></i>Delete</a>
        <hr>    
        @endforeach
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center HeadersForGames ">
        <p><i class="fa fa-gamepad"></i>Games</p>
        </div>
        <div class="panel-body BodyForGames">
            @foreach ($game as $game)
            {{ $game->Game_Name }}<hr>

            @endforeach
        </div>
    </div>
</div>


<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading text-center HeadersForGames">
        <p><i class="fa fa-comment"></i>Last Suggestions</p>
        </div>
        <div class="panel-body BodyForGames">
            @foreach ($Sugg as $Suggestions)
            <input type="hidden" name="id" value="{{ $Suggestions->id }}">
            Comment: {{ $Suggestions->Comment }} <br>
            GameName: {{ $Suggestions->Game->game_name_en }}<br>
            User: {{ $Suggestions->User->user_name }}
            <a href="{{ route('DltSuggestions', $Suggestions->id) }}"
                class="btn btn-danger delcomment"><i class='fa fa-close'></i>Delete</a>
            <hr>
            @endforeach

        </div>
    </div>
</div>
</div>
</div>

</div>
@endsection
