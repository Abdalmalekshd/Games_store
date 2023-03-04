<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Suggestion;
use App\Models\Rating;
use App\Http\Requests\CommentRequest;
use App\Mail\NewCommentAdded;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\NewAccessToken;

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

        //Start Rating Calculating
        
        $rating=Suggestion::select('rating')->where('Game_id',$Game_id)->sum('rating')/5;
            $numofusers=Suggestion::select('rating')->where('Game_id',$Game_id)->where('rating','>',0)->count();
            

            
            //End Rating Calculating
            $comments=Suggestion::with('Game')->where('Game_id',$Game_id)->get();

            $commentsnum=Suggestion::with('Game')->where('Game_id',$Game_id)->count();

return view('Interfaces/FullGame',compact('Game','comments','commentsnum','rating','numofusers'));
}

public function Comments(CommentRequest $req){
    
$comment=Suggestion::create([
    'Comment' =>$req->comment,
    'rating'=>$req->rating,
    'Game_id' =>$req->id,
    'User_id' =>auth('web')->id(),
]);

$admin=Admin::all();
Mail::to($admin)->send(new NewCommentAdded);

if ($comment) {
    // return Redirect()->back()->with('success', 'Game Has Been Added');
    return response()->json(['status' =>true,
'Msg'=>__('messages.Thanks Review')]);



} else {
    return 'error';
}
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
