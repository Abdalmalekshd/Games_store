@extends('layouts.Adminmaster')
@section('Title', 'Home')
@section('content')
    <div class="games">

        <div class="games-carousel">


            @if(empty($gameser))
            @foreach ($Games as $Game)
            <div class="game">
                <div class="TowFaceImage">
                    <div class="box">
                        <input type="hidden" class="Gamedel{{$Game->id}}"/>
                        <div class="face front game-cover"><img src="{{ url('Images/' . $Game->photo) }}"
                                alt="{{ $Game->Game_Name }}" />
                        </div>
                        <div class="face back"><a href="{{ route('EditGame',$Game->id) }}" class="btn btn-success"><i class='fa fa-Edit'></i>{{ __('messages.Update') }}</a> &nbsp; &nbsp; 
                            <button
                            games_id='{{ $Game->id }}''
                                class="btn btn-danger deleteGame">
                                <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button></div>
                            
                        </div>
                </div>
                <div class="game-info">
                    <p class="game-title">{{ $Game->Game_Name }}</p>
                    <p class="game-viewership">Rating</p>
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

        @else
        @foreach ($Games as $Game)
                <div class="game">
                    <div class="TowFaceImage">
                        <div class="box">
                            <input type="hidden" class="Gamedel{{$Game->id}}"/>
                            <div class="face front game-cover"><img src="{{ url('Images/' . $Game->photo) }}"
                                    alt="{{ $Game->Game_Name }}" />
                            </div>
                            <div class="face back"><a href="{{ route('EditGame',$Game->id) }}" class="btn btn-success"><i class='fa fa-Edit'></i>{{ __('messages.Update') }}</a> &nbsp; &nbsp; 
                                <button
                                games_id='{{ $Game->id }}''
                                    class="btn btn-danger deleteGame">
                                    <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button></div>
                                
                            </div>
                    </div>
                    <div class="game-info">
                        <p class="game-title">{{ $Game->Game_Name }}</p>
                        <p class="game-viewership">Rating</p>
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

        @endif

            
            
        </div>
        
    </div>


    <div id="success_msg" class="alert alert-danger Gamedel" >
        {{ __('messages.Game Deleted') }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
        $(document).on('click','.deleteGame',function(e){
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

                    $('#success_msg').show();
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
</script>
@endsection
