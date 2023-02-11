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
        <label class="game-title" style="font-size: 40px;">Game Name:</label>
        <input type="text" style="height:60px;margin-left:-100px;text-align:center" value="{{ $Game->Game_Name }}" readonly>
        <span style="margin-left: 30px;">Game Story:</span><br>
        <div name="" readonly id=""
        style="margin-left: -13px;text-align: center;width:518px;
        background-color: white;color: black;
        margin-top: -95px;overflow-wrap: break-word;overflow-x: scroll;
        @if (LaravelLocalization::getCurrentLocale() == 'ar')
                style="direction: rtl;"

                @else
                style="direction: ltr;"

                @endif  ">{{ $Game->Game_detail }}</div>
        <label class="game-viewership" style="font-size: 40px;margin-top: -110px;">Game Rating:</label>
        <input type="text" style="height:60px;margin-left:-100px;text-align:center;margin-top: -95px;" value="" readonly>
        <label for="" style="margin-top: -75px;">Game Category:</label>
        <input type="text" value="@if ($Game->Game_Cat == 1)
        {{ __('messages.horror') }}
        @elseif($Game->Game_Cat== 2)
        {{ __('messages.Action') }}
    @elseif($Game->Game_Cat== 3)
    {{ __('messages.Adventure') }}
    @elseif($Game->Game_Cat== 4)
    {{ __('messages.Survival') }}
    @endif" style="text-align: center; margin-left:-100px">
        <a href="{{ route('Download', $Game->id) }}"
            download="{{ $Game->link }}"  class="btn btn-primary"
        style="margin-left: 20px"><i class="fa fa-download"></i>Click To Start Download</a>
    </div>
    {{-- <a class="btn btn-success" href="{{URL('Game_Files/'.$Game->link)}}" target="_blank">
        <i class="fa fa-download"></i> Download File
    </a> --}}
</div>
</div>
</div>
{{-- <a href="{{ url('admin/file/download', $file->name_file) }}"
    download="{{ $file->file }}" class="btn btn-primary">Download</i></a> --}}

<form id="form_data" action="" method="POST">
    @csrf

<p>
    <label for=""  style='margin-left:480px;color:#CC1313;Font-size:30px'>{{ __('messages.Rate') }}</label>
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
                Number Of Comments:{{ $commentsnum }}<br />

                <input type="text" name="comment"  size="30"  placeholder="{{ __('messages.addcomment') }}"
                @if (LaravelLocalization::getCurrentLocale() == 'ar')
                style="direction: rtl;"

                @else
                style="direction: ltr;"

                @endif/>
                {{-- <a id="Comment" class="btn btn-danger" >Comment</a> --}}
                <button id="Comment" class="btn btn-danger"  value="Comment" >Comment</button>

                <div class="alert alert-success" id="success_msg">
                Thanks For your Comment and Review
                </div>

                <hr style="margin-bottom:-20px">

                <br />
                @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

<br />

                @if (isset($comments) && $comments->count() > 0)
        @foreach ($comments as $comment)
        <span class="comment">{{ $comment ->User->user_name}} <span class="com">{{ $comment -> Comment}}</span></span><br>
        <label class="comment-date">{{ $comment -> created_at}} </label><hr>
        @endforeach
        @endif
{{-- لازم حط اليوم اللي انحط فيه التعليق --}}
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

                
                var formdata=new FormData($('#form_data')[0]);
        
            $.ajax({
                type: 'post',
                // enctype: 'multipart/form-data',
                url: "{{ route('Comments') }}",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status == true) {

                        $('#success_msg').show();
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
