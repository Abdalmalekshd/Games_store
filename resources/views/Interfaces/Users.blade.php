@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'Users')

<?php
$NoSerachText = '';
?>
@section('content')



        <table class="main-table  table table-bordered">
            <tr>
                <th>{{ __("messages.name") }}</th>
                <th>{{ __("messages.Email") }}</th>
                <th>{{ __("messages.user_name") }}</th>
                <th>{{ __('messages.Control') }}</th>
            </tr>

            @foreach ($users as $user)

                    <tr class="userdel{{ $user->id }}">

                    <td>
                    {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}

                    </td>

                    <td>
                    {{ $user->user_name }}
                    </td>

                    <td>
                        <button 
                            class="btn btn-danger deluser" user_id="{{ $user->id}}">
                            <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button>
                            
                    </td>
                    </tr>

                    @endforeach
        </table>

        <div class="alert alert-danger delmsg" id="success_msg">{{ __('messages.User Deleted') }}</div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <script>
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
    
                        $('#success_msg').show();
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
    </script>
@endsection
