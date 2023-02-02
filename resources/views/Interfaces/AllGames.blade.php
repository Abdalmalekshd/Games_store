@extends('layouts.Adminmaster')
@section('Title', 'Home')
@section('content')
    <div class="games">

        <div class="games-carousel">
            @foreach ($Games as $Game)
                <div class="game">
                    <div class="TowFaceImage">
                        <div class="box">
                            <div class="face front game-cover"><img src="{{ url('Images/' . $Game->photo) }}"
                                    alt="{{ $Game->Game_Name }}" />
                            </div>
                            <div class="face back"><a href="{{ route('EditGame',$Game->id) }}" class="btn btn-success">{{ __('messages.Update') }}</a> &nbsp; &nbsp; <a
                                    href="{{ route('DeleteGame',$Game->id) }}" class="btn btn-Danger">{{ __('messages.Dlt') }}</a></div>
                        </div>
                    </div>
                    <div class="game-info">
                        <p class="game-title">{{ $Game->Game_Name }}</p>
                        <p class="game-viewership">{{ $Game->rating }}</p>
                    </div>

                    <div class="game-categories">
                        <span>
                                @if ($Game->game_category== 1)
                                {{ __('messages.horror') }}
                                @elseif($Game->game_category== 2)
                                {{ __('messages.Action') }}
                                @elseif($Game->game_category== 3)
                                {{ __('messages.Adventure') }}
                                @elseif($Game->game_category== 4)
                                {{ __('messages.Survival') }}

                                @endif
                            </span>
                    </div>
                </div>
            @endforeach
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('Error'))
            <div class="alert alert-danger">{{ Session::get('Error') }}</div>
        @endif
        </div>
    </div>

@endsection
