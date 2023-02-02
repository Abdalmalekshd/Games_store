@extends('layouts.Adminmaster')

<link rel="stylesheet" href="{{ asset('admin.css') }}">

@section('Title', 'AdminHome')
<?php
$NoSerachText = '';
?>

@section('content')




    <main role="main">

        <section class="panel important">
            <h2>{{ __('messages.Add New Game') }}</h2>
            <form action="{{ route('updategame', $Game->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="twothirds">

            <input type="hidden" value="{{ $Game->id }}" />
                    {{ __('messages.Game_name_en') }}<br />
                    <input type="text" name="game_name_en" size="30" autocomplete="off" value="{{ $Game->game_name_en }}" /><br />
                    @error('game_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_name_ar') }}<br />
                    <input type="text" name="game_name_ar" size="30" style="direction: rtl;" autocomplete="off" value="{{ $Game->game_name_ar }}" /><br />
                    @error('game_name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Details_en') }}<br />
                    <textarea name="details_en" rows="8" cols="45" autocomplete="off" >{{ $Game->game_details_en}}</textarea><br />
                    @error('details_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Details_ar') }}<br />
                    <textarea name="details_ar" rows="8" cols="45" autocomplete="off" style="direction: rtl;" class='det_ar' >{{ $Game->game_details_ar}}</textarea><br />
                    @error('details_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Img') }}<br />
                    <input type="file" name="photo"><img style='width:150px; height: 200px;'
                     src="{{ url('Images/', $Game->photo) }}" alt=""><br />
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    {{ __('messages.Game_Cat_en') }}<br />

                    <select class="custom-select m-1" name='game_category_en'>
                        <option value="1" @if ($Game->game_category_en == 1)
                         selected
                            @endif>Horror</option>
                        <option value="2" @if ($Game->game_category_en == 2)
                            selected
                               @endif>Action</option>
                        <option value="3" @if ($Game->game_category_en == 3)
                            selected
                               @endif>Adventure</option>
                        <option value="4" @if ($Game->game_category_en == 4)
                            selected
                               @endif>Survival</option>
                    </select>
                    {{-- <br />
                    <br /> --}}
                    {{ __('messages.Game_Cat_ar') }}<br />

                    <select class="custom-select m-1" name='game_category_ar'>

                        <option value="1">رعب</option>
                        <option value="2">أكشن</option>
                        <option value="3">مغامرة</option>
                        <option value="4">نجاة</option>
                       {{-- @endif --}}
                    </select>

                    <br />
                    <br />
                    {{ __('messages.Game_files') }}<br />
                    <input type="file" name="link"  /><div>{{  $Game->link }}</div><br />
                    @error('link')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>


                    <input type="submit" value="{{ __('messages.Update') }}" />



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
