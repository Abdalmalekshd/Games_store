@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'Users')

<?php
$NoSerachText = '';
?>
@section('content')



        <table class="main-table  table table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>UserName</th>
                <th>Control</th>
            </tr>

            @foreach ($users as $user)

                    <tr>

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
                    {{-- <a href=''
                        class='btn btn-success'><i class='fa fa-edit'></i>Edit</a> --}}
                        <a href="{{ route('DltUser', $user->id) }}"
                            class="btn btn-danger delcomment">
                            <i class='fa fa-close'></i> Delete</a>
                            <a href="#" 
                            class="btn btn-primary blockUser">
                            <i class='fa fa-ban'></i>Block</a>
                    </td>
                    </tr>

                    @endforeach
        </table>

@endsection
