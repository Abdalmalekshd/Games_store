@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'Dashboard')

<?php
$NoSerachText = '';
?>
@section('content')



        <table class="main-table  table table-bordered">
            <tr>
                <th>Comments</th>
                <th>Game</th>
                <th>User</th>
                <th>Control</th>
            </tr>

            @foreach ($Sugg as $Sugg)

                    <tr>

                    <td>
                    {{ $Sugg->Comment }}
                    </td>

                    <td>
                    {{ $Sugg->Name }}
                    </td>

                    <td>
                    {{ $Sugg->USERNAME }}
                    </td>

                    <td>
                    {{-- <a href=''
                        class='btn btn-success'><i class='fa fa-edit'></i>Edit</a> --}}
                        <a href="{{ route('DltSuggestions', $Sugg->id) }}"
                            class="btn btn-danger delcomment">
                            <i class='fa fa-close'></i> Delete</a>
                    </td>
                    </tr>

                    @endforeach
        </table>

@endsection
