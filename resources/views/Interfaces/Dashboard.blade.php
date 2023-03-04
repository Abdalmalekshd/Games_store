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


<div class="users col-md-3" >
    <label for="">Number Of Users</label>

    <span><a href="">{{ $countUsers }}</a></span>
</div>

</div>

{{-- <div class="visiters_per_Day col-md-3">
    <label for="">Visiters For That Today</label>

    <span>200</span>
</div>

<div class="visiters_per_Year col-md-3">
    <label for="">Visiters For This Year</label>

    <span>10000</span>
</div>
</div> --}}
<div class="row" >
<div class="col-sm-6" style="margin-left: 300px;">
    <div class="panel panel-default">
        <div class="panel-heading text-center headerforusers">
        <p><i class="fa fa-users"></i>Users</p>
        </div>
        <div class="panel-body forusers">
            @foreach ($user as $user)
        {{ $user->name }}&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
        <button 
                            class="btn btn-danger deluser" user_id="{{ $user->id}}">
                            <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button>
        <hr>    
        @endforeach
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-4" style="margin-left: -150px">
    <div class="panel panel-default">
        <div class="panel-heading text-center HeadersForGames ">
        <p><i class="fa fa-gamepad"></i>Games</p>
        </div>
        <div class="panel-body BodyForGames">
            @foreach ($game as $game)
            <p style="display: none;" class="Gamedel{{ $game->id }}"></p>
            {{ $game->Game_Name }}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                
<a href="{{ route('EditGame',$game->id) }}" class="btn btn-success">{{ __('messages.Update') }}</a> 
    &nbsp; &nbsp; 
    <a games_id="{{ $game->id }}"  class="btn btn-Danger delete_Game">{{ __('messages.Dlt') }}</a>
            <hr>
            @endforeach
        </div>
    </div>
</div>


<div class="col-sm-4" style="margin-left: 150px">
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
            <button
            comment_id='{{ $Suggestions->id }}'
                class="btn btn-danger delcomment">
                <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button>
            <hr>
            @endforeach

        </div>
    </div>
</div>
</div>
</div>
</div>

</div>

<div id="game_msg" class="alert alert-danger Gamedel" >
    {{ __('messages.Game Deleted') }}
</div>

<div class="alert alert-danger delmsg" id="user_msg">
    {{ __('messages.User Deleted') }}</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    //Del Game Ajax Section
    $(document).on('click','.delete_Game',function(e){
        e.preventDefault();

        let GameId=$(this).attr('games_id');
        
    $.ajax({
        type: 'post',
        url: "{{ route('DeleteGame') }}",
        data: {
            '_token':"{{csrf_token()}}",
            'id':GameId
        },
        success: function (data) {

            if (data.status == true) {

                $('#game_msg').show();
            }
            $('.Gamedel'+data.id).remove();
        },
        
        error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
});    


//Del User Ajax Section
$(document).on('click','.deluser',function(e){
        e.preventDefault();

        let userid=$(this).attr('user_id');
        
    $.ajax({
        type: 'post',
        url: "{{ route('DltUser') }}",
        data: {
            '_token':"{{csrf_token()}}",
            'id':userid
        },
        success: function (data) {

            if (data.status == true) {

                $('#user_msg').show();
            }
            $('.userdel'+data.id).remove();
        },
        
        error: function (reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $("#" + key + "_error").text(val[0]);
            });
        }
    });
});

//Del Comment Ajax Section

$(document).on('click','.delcomment',function(e){
                e.preventDefault();
    
                let commentid=$(this).attr('comment_id');
                
            $.ajax({
                type: 'post',
                url: "{{ route('DltSuggestions') }}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'id':commentid
                },
                success: function (data) {
    
                    if (data.status == true) {
    
                        $('#comment_msg').show();
                    }
                    $('.commentdel'+data.id).remove();
                },
                
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
</script>




{{-- <div id="game_msg" class="alert alert-danger" >
    {{ __('messages.Game Deleted') }}
</div>

<div class="alert alert-danger" id="user_msg" style="display:none;margin-top:400px;width:500px;margin-left:450px;text-align:center;">
    {{ __('messages.User Deleted') }}</div>

    <div class="alert alert-danger" id="comment_msg" style="display:none;margin-top:400px;;width:500px;margin-left:450px;text-align:center;">{{ __('messages.Comment Deleted') }}</div> --}}

@endsection
