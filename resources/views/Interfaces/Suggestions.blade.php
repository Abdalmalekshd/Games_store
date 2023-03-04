@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'Suggestions && Comments')

<?php
$NoSerachText = '';
?>
@section('content')



        <table class="main-table  table table-bordered">
            <tr>
                <th>{{ __("messages.Suggestions") }}</th>
                <th>{{ __("messages.Game") }}</th>
                <th>{{ __("messages.user_name") }}</th>
                <th>{{ __('messages.Control') }}</th>

            </tr>

            @foreach ($Sugg as $Sugg)

            <tr class="commentdel{{ $Sugg->id }}">

                    <td>
                    {{ $Sugg->Comment }}
                    </td>

                    <td>
                    {{ $Sugg->Game->game_name_en }}
                    </td>

                    <td>
                    {{ $Sugg->User->user_name }}
                    </td>

                    <td>
                        <button
                        comment_id='{{ $Sugg->id }}'
                            class="btn btn-danger delcomment">
                            <i class='fa fa-close'></i>{{ __('messages.Dlt') }}</button>
                    </td>
                    </tr>

                    @endforeach
        </table>
        <div class="alert alert-danger delmsg" id="success_msg">{{ __('messages.Comment Deleted') }}</div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <script>
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
    
                        $('#success_msg').show();
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
@endsection
