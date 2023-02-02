@extends('layouts.usermaster')

<link rel="stylesheet" href="{{ asset('user.css') }}">

@section('Title')
<?php $NoSerachText = '';?>

@section('content')
<div class="games">
    {{-- <h3>Popular <span class="title-highlight">Games</span></h3> --}}
    <div class="games-carousel">

<div class="game fullgame">
<div><img src="{{ url('Images/' . $Game->photo)}}"
    alt="{{ $Game->Game_Name }}" class="gameimg"/></div>
    <div class="game-info">
        <label class="game-title" style="font-size: 40px;">Game Name:</label><input type="text" style="height:60px;margin-left:-7px;text-align:center" value="{{ $Game->Game_Name }}" readonly>
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
        <input type="text" style="height:60px;margin-left:-100px;text-align:center;margin-top: -95px;" value="{{ $Game->rating }}" readonly>
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
{{-- <td><a href="{{ url('admin/file/download', $file->name_file) }}"
    download="{{ $file->file }}" class="btn btn-primary">Download</i></a></td> --}}

<form action="{{ route('Comments') }}" method="post" >
<label for=""  style='margin-left:480px;color:rgb(163, 163, 163);Font-size:20px'>{{ __('messages.Rate') }}</label>

<input type="hidden" name="id" value="{{ $Game->id }}">

<select  class='form-select form-select-sm' style='margin-left:480px;width:210px;' name="rating" id="">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        </select>


<main role="main">

    <section class="panel important">
        <h2>{{ __('messages.comment') }} </h2>
            @csrf
            <div class="twothirds">
                Number Of Comments:{{ $commentsnum }}<br />

                <input type="text" name="comment"  size="30"  placeholder="{{ __('messages.addcomment') }}"
                @if (LaravelLocalization::getCurrentLocale() == 'ar')
                style="direction: rtl;"

                @else
                style="direction: ltr;"

                @endif/><br />
                @error('comment')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

<br />

                @if (isset($comments) && $comments->count() > 0)
        @foreach ($comments as $comment)
        <label class="comment">{{ $comment ->User->user_name}} </label><br>
        <label class="comment">{{ $comment -> Comment}} </label><hr>
        @endforeach
        @endif
{{-- لازم حط اليوم اللي انحط فيه التعليق --}}
            </div>



            </div>


    </section>


</main>

</form>
{{--
<div class="commentandusername">

<main role="main" >
    <section class="panel important">
        <h2>{{ __('messages.Gamecomments') }}</h2>
        <div class="commentanduser">

        {{-- @if (isset($comments) && $comments->count() > 0)
        @foreach ($comments as $comment)
        <label class="comment">{{ $comment ->User->user_name}} </label><br>
        <label class="comment">{{ $comment -> Comment}} </label><hr>
        @endforeach
        @endif
    </div>


    </section>

</main>
</div> --}}


@endsection
