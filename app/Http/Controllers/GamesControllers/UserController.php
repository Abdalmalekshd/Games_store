<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Suggestion;
use App\Models\User;
use Symfony\Component\HttpFoundation\File\File;

class UserController extends Controller
{

public function fullgamedetails($Game_id){

    $Game=Game::select(
        'id',
        'game_name_'. LaravelLocalization::getCurrentLocale() . ' as Game_Name',
        'game_details_' . LaravelLocalization::getCurrentLocale() .' as Game_detail',
        'photo' ,
        'rating',
        'game_category_'. LaravelLocalization::getCurrentLocale() . ' as Game_Cat',
        'link'
        )->Find($Game_id);

        $comments=Suggestion::with('Game')->where('Game_id',$Game_id)->get();

        $commentsnum=Suggestion::with('Game')->where('Game_id',$Game_id)->count();

return view('Interfaces/FullGame',compact('Game','comments','commentsnum'));
}

public function Comments(Request $req){

$comment=Suggestion::create([
    'Comment' =>$req->comment,
    'Game_id' =>$req->id,
    'User_id' =>session('user_id')
]);
//This Should by Displayed In Ajax
}




public function Download($gameid){

        // $file = File::where('file',$fileName)->get();
        // $download = public_path('images\files',$file);
        // return response()->download($download);

        return $game_link = Game::select('link')->where('id',$gameid)->get();
        // $download = public_path('Game_Files',$game_link);
        $download = public_path().'\Game_Files\ '. $game_link;

        $headers = [
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'application/zip',
        ];

        return response()->download($download,$game_link, $headers);




}

}
