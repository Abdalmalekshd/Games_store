<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Suggestion;
use App\Models\Rating;
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
        'game_category_'. LaravelLocalization::getCurrentLocale() . ' as Game_Cat',
        'link'
        )->Find($Game_id);

            // $ratings=Rating::where('Game_id',$Game_id)->where('rating',5)->sum('rating');
            // $numofusers=Rating::where('Game_id',$Game_id)->where('rating',5)->count();

            // $rating3=Rating::where('Game_id',$Game_id)->where('rating',3)->sum('rating');
            // $numofuser3=Rating::where('Game_id',$Game_id)->where('rating',3)->count();
            // return $ratings/$numofusers;
            // return $rating3/$numofuser3;


        $comments=Suggestion::with('Game')->where('Game_id',$Game_id)->get();

        $commentsnum=Suggestion::with('Game')->where('Game_id',$Game_id)->count();

return view('Interfaces/FullGame',compact('Game','comments','commentsnum'));
}

public function Comments(Request $req){
// $game=Game::find($req->id);
$RateGame=Rating::create([
    'rating'=>$req->rating,
    'Game_id'=>$req->id,
'User_id' =>session('user_id')
]);
    
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
