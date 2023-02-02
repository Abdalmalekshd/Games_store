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
            <form action="{{ route('Create_game') }}" method="post" enctype="multipart/form-data">
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

                    <input type="submit" value="{{ __('messages.Save') }}" />

                </div>



                </div>
            </form>
        </section>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('Error'))
            <div class="alert alert-danger">{{ Session::get('Error') }}</div>
        @endif
    </main>

@endsection
