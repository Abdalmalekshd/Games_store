@extends('layouts.usermaster')

<link rel="stylesheet" href="{{ asset('user.css') }}">

@section('Title', 'Horror')


@section('content')

<div class="games">

    <div class="games-carousel">
        <div class="games">

            <div class="games-carousel">

        @if(empty($gameser))
        @foreach ($game as $Game)
        <div class="container">
            <div class="row">
                <div class="game">

                    <div class="game-cover"><a
                        href="{{ route('fullgame',$Game->id) }}"><img
                        src="{{ url('Images/' . $Game->photo) }}"
                            alt="{{ $Game->Game_Name }}" /></a>
                    </div>
            </div>
            <div class="game-info">
                <p class="game-title">{{ $Game->Game_Name }}</p>
                <p class="game-viewership">{{ $Game->rating }}</p>
            </div>

            <div class="game-categories">
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
                    </div>
                </div>
            </div>
        </div>
        {{-- {{!! $game->links() !!}} --}}
    @endforeach
    @else
    @foreach ($gameser as $Gameser)

<div class="row">
    <div class="game">

            <div class="game-cover">
                <a href="{{ route('fullgame',$Gameser->id) }}">
                <img src="{{ url('Images/' . $Gameser->photo) }}"
                    alt="{{ $Gameser->Game_Name }} " /></a>
            </div>
    </div>
    <div class="game-info">
        <p class="game-title">{{ $Gameser->Game_Name }}</p>
        <p class="game-viewership">{{ $Gameser->rating }}</p>
    </div>

    <div class="game-categories">
        <div>
            <span>
                    @if ($Gameser->game_category== 1)
                    {{ __('messages.horror') }}
                    @elseif($Gameser->game_category== 2)
                    {{ __('messages.Action') }}
                @elseif($Gameser->game_category== 3)
                {{ __('messages.Adventure') }}
                @elseif($Gameser->game_category== 4)
                {{ __('messages.Survival') }}

                @endif
</div>
</div>
</div>
@endforeach

    @endif


</div>



@endsection
