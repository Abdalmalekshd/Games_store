@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'AddGame')
<?php
$NoSerachText = '';
?>

@section('content')




    <main role="main">

        <section class="panel important">
            <h2>{{ __('messages.Add New Game') }}</h2>
            <form id='createForm'  method="post" enctype="multipart/form-data">
                @csrf
                <div class="twothirds">

                    {{ __('messages.Game_name_en') }}<br />
                    <input type="text" name="game_name_en" size="30"  /><br />
                    @error('game_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_name_ar') }}<br />
                    <input type="text" name="game_name_ar" size="30"  style="direction: rtl;"/><br />
                    @error('game_name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Details_en') }}<br />
                    <textarea name="details_en" rows="20" cols="45" ></textarea><br />
                    @error('details_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Details_ar') }}<br />
                    <textarea name="details_ar" rows="20" cols="45"  class='det_ar' style="direction: rtl;"></textarea><br />
                    @error('details_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Img') }}<br />
                    <input type="file" name="photo"><br />
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Cat_en') }}<br />

                    <select class="custom-select m-1" name='game_category_en'>
                        <option value="0"></option>
                        <option value="1">Horror</option>
                        <option value="2">Action</option>
                        <option value="3">Adventure</option>
                        <option value="4">Survival</option>
                    </select>


                    {{-- <br />
                    <br /> --}}


                    {{ __('messages.Game_Cat_ar') }}<br />

                    <select class="custom-select m-1" name='game_category_ar'>
                        <option value="0"></option>
                        <option value="1">رعب</option>
                        <option value="2">أكشن</option>
                        <option value="3">مغامرة</option>
                        <option value="4">نجاة</option>
                    </select>

                    <br />
                    <br />
                    {{ __('messages.Game_files') }}<br />
                    <input type="file" name="link" /><br />
                    @error('link')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>

                    <button id="createGame" >{{ __('messages.Save') }}</button>

                </div>



                </div>
            </form>
        </section>
        {{-- @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif --}}
        
        <div id="success_msg" class="alert alert-success" style="display: none;">
            Game Has Been Added
        </div>

        @if (Session::has('Error'))
            <div class="alert alert-danger">{{ Session::get('Error') }}</div>
        @endif
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
        $(document).on('click','#createGame',function(e){
            e.preventDefault();

            
            var formdata=new FormData($('#createForm')[0]);
    
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route('Create_game') }}",
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
