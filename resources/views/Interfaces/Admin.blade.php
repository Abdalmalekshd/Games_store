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
                    <input type="text" name="game_name_en" size="30"  />
                    <small id="game_name_en_error" class='btn-danger' style="margin-right: 40px;"></small>
                    <br />
                    {{ __('messages.Game_name_ar') }}<br />
                    <input type="text" name="game_name_ar" size="30"  style="direction: rtl;"/>
                    <small id="game_name_ar_error" class='btn-danger' style="margin-right: 40px;"></small>
                    <br />
                    {{ __('messages.Game_Details_en') }}<br />
                    <textarea name="details_en" rows="20" cols="45" ></textarea>
                    <small id="details_en_error" class='btn-danger' style="margin-right: 40px;"></small>
                    <br />

                    {{ __('messages.Game_Details_ar') }}<br />
                    <textarea name="details_ar" rows="20" cols="45"  class='det_ar' style="direction: rtl;"></textarea>
                    <small id="details_ar_error" class='btn-danger' style="margin-right:40px;"></small>
                    <br />
                    {{ __('messages.Game_Img') }}<br />
                    <input type="file" name="photo">
                    <small id="photo_error" class='btn-danger' style="margin-right: 40px;"></small>
                    <br />
                    {{ __('messages.Game_Cat_en') }}<br />

                    <select class="custom-select m-1"  name='game_category_en'>
                        <option value="0"></option>
                        <option value="1">Horror</option>
                        <option value="2">Action</option>
                        <option value="3">Adventure</option>
                        <option value="4">Survival</option>
                    </select>

                    {{ __('messages.Game_Cat_ar') }}<br />
                    <select class="custom-select m-1"  name='game_category_ar'>
                        <option value="0"></option>
                        <option value="1">رعب</option>
                        <option value="2">أكشن</option>
                        <option value="3">مغامرة</option>
                        <option value="4">نجاة</option>
                    </select>

                    <br />
                    <br />
                    {{ __('messages.Game_files') }}<br />
                    <input type="file" name="link" />
                <small id="link_error" class='btn-danger' style="margin-right: 40px;"></small>
                <br />
                </div>
                <div>

                    <button id="createGame" >{{ __('messages.Save') }}</button>

                </div>



                </div>
            </form>
        </section>
        
        
        <div id="success_msg" class="alert alert-success Add_success_msg" >
            {{ __("messages.Game Added") }}
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
        $(document).on('click','#createGame',function(e){
            e.preventDefault();
            // e.unbind();
            

            $('#game_name_en_error').text('');
            $('#game_name_ar_error').text('');
            $('#details_en_error').text('');
            $('#details_ar_error').text('');
            $('#photo_error').text('');
            $('#link_error').text('');

            
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
                    document.getElementById('createForm').reset();
                    
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
