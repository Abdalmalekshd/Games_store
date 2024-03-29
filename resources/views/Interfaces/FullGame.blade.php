@extends('layouts.usermaster')

<link rel="stylesheet" href="{{ asset('user.css') }}">

<title>{{ $Game->Game_Name }}</title>
<?php $NoSerachText = '';?>

@section('content')
<div class="games">
    {{-- <h3>Popular <span class="title-highlight">Games</span></h3> --}}
    <div class="games-carousel">

<div class="game fullgame">
<div><img src="{{ url('Images/' . $Game->photo)}}"
    alt="{{ $Game->Game_Name }}" class="gameimg"/></div>
    <div class="game-info">
        <label class="game-name">Game_Name:</label>
        <input type="text" class="gamenameinput" value="{{ $Game->Game_Name }}" readonly>
        <label class="gamestory">Game_Story:</label><br>
        <div name="" readonly id="" class="gamestorydiv"
        style="
        @if (LaravelLocalization::getCurrentLocale() == 'ar')
                style="direction: rtl;"
                @else
                style="direction: ltr;"
                @endif  ">{{ $Game->Game_detail }}</div>
        <label class="game-Rating" >Game_Rating:</label>
        <input type="text" class="gameratinginput" value="@if($rating<=5)
        {{ $rating }}
        @else
            5
        @endif" readonly>
        <label for="" class="gamecat">Game_Category:</label>
        <input type="text" class="gamecatinput" value="@if ($Game->Game_Cat == 1)
        {{ __('messages.horror') }}
        @elseif($Game->Game_Cat== 2)
        {{ __('messages.Action') }}
    @elseif($Game->Game_Cat== 3)
    {{ __('messages.Adventure') }}
    @elseif($Game->Game_Cat== 4)
    {{ __('messages.Survival') }}
    @endif" >

    <a class="btn btn-primary down" href="{{URL('Game_Files/'.$Game->link)}}" target="_blank"><i class="fa fa-download"></i>Download The Game</a>
        
    </div>
   
</div>
</div>
</div>

<form id="Addcommentform" action="" method="POST">
    @csrf

<p>
    <label for=""  style='margin-left:400px;color:#CC1313;Font-size:30px'>{{ __('messages.Rate') }}</label>
</p>
<input type="hidden" name="id" value="{{ $Game->id }}">
<div class="rating">

    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
</div>

<main role="main" style="margin-left:180px">

    <section class="panel important" >
        <h2>{{ __('messages.comment') }} </h2>
            <div class="twothirds">
                <div style="margin-right:70px">Number Of Comments: {{ $commentsnum }}</div><br />

                <textarea type="text" name="comment" style="margin-right:60px;margin-bottom:20px;" size="30"  placeholder="{{ __('messages.addcomment') }}"
                @if (LaravelLocalization::getCurrentLocale() == 'ar')
                style="direction: rtl;"

                @else
                style="direction: ltr;"

                @endif/></textarea><br>
                <button id="Comment" 
                class="btn btn-danger" style="margin-right:60px;" value="Comment" >Comment</button>
                <br>
                <small id="comment_error" class='btn-danger' style="margin-right: 40px;"></small>

                <div class="alert alert-success" id="success_msg" style="display:none">
                {{ __('messages.Thanks Review') }}
                </div>
                
                <hr style="margin-bottom:-20px">

                <br />
                

<br />

                @if (isset($comments) && $comments->count() > 0)
        @foreach ($comments as $comment)
        <span class="comment">{{ $comment ->User->user_name}} <span class="com">{{ $comment -> Comment}}</span></span><br>
        <label class="comment-date">{{ $comment -> created_at}} </label><hr>
        @endforeach
        @endif

            </div>



            </div>


    </section>



</main>

</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
            $(document).on('click','#Comment',function(e){
                e.preventDefault();

                $('#comment_error').text('');

                var formdata=new FormData($('#Addcommentform')[0]);
        
            $.ajax({
                type: 'post',
                url: "{{ route('Comments') }}",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == true) {

                        $('#success_msg').show();
                    document.getElementById('Addcommentform').reset();

                    }
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

@endsection
