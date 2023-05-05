<?php

namespace App\Http\Controllers\GamesControllers;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Traits\GameLinkTrait;
use App\Traits\GamePhotoTrait;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\GameRequest;
use App\Mail\NewGameAddedMail;
use App\Models\Admin;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



class AdminController extends Controller
{

    use GamePhotoTrait;
    use GameLinkTrait;

    public function admin()
    {
        return view('interfaces/admin');
    }




//Begin  Add Game Function
    public function Addgame(GameRequest $req)
    {


        $Game_Link = $this->saveGameLink($req->link, 'Game_Files');

        $File_name = $this->saveImage($req->photo, 'Images/');





        $games = Game::create([
            'game_name_ar'    => $req->game_name_ar,
            'game_name_en'    => $req->game_name_en,
            'game_details_ar' => $req->details_ar,
            'game_details_en' => $req->details_en,
            'photo'           => $File_name,
            'game_category_en' => $req->game_category_en,
            'game_category_ar' => $req->game_category_ar,
            'link'           => $Game_Link,
            'admin_id'        =>Auth('admin')->id(),
        ]);
        $user = User::select('email')->get();
        
        Mail::to($user)->send(new NewGameAddedMail());

        
        if ($games) {
            
            return response()->json(["status" =>true,
        'msg'=>__('messages.Game Added')],
    );
        } else {
            return response()->json(['status' =>false,
        'Msg'=>__('messages.Game Not Added')]);

        }
    }

    //End  Add Game Function

 //Begin Select All Game Function
    public function AllGames()
    {
        $Games = Game::select(
            'id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo',
            
        )->get();
        // $Game_id=$Games->id;
        // $rating=Rating::where('Game_id',$Games->id)->sum('rating')/5;
        //     $numofusers=Rating::where('Game_id',$Games->id)->count();
        $rating='';
        return view('interfaces/AllGames', compact('Games','rating'));
    
    }
    //End Select All Game Function

    //Begin Update Function
public function Edit($Game_id){

        $Game=Game::select()->find($Game_id);

        

    return view('Interfaces/update',compact('Game'));


}

public function Update(Request $req,$Game_id){
    $game=Game::find($Game_id);

$game->update([
    'game_name_ar'    => $req->game_name_ar,
    'game_name_en'    => $req->game_name_en,
    'game_details_ar' => $req->details_ar,
    'game_details_en' => $req->details_en,

'game_category_en' => $req->game_category_en,
'game_category_ar' => $req->game_category_ar,
]);
//update Photo Code
if ($req->hasFile('photo')) {
    $des = 'Images' . $game->photo;
    if (File::exists($des)) {
        File::delete($des);
    }

    $file_extension = $req->photo->getClientOriginalExtension();
    $Photo= time() . '.' . $file_extension;
    $path = 'Images';
    $req->photo->move($path, $Photo);
    $game->photo = $Photo;
}

if ($req->hasFile('link')) {
    $desti = 'Game_Files' . $game->link;
    if (File::exists($desti)) {
        File::delete($desti);
    }
    $file_extension = $req->link->getClientOriginalExtension();
    $link = time() . '.' . $file_extension;
    $path = 'Game_Files';
    $req->link->move($path, $link);
    $game->link = $link;
}


$game->save();

if($game){
    return redirect()->route('AllGames');
}else{
    return redirect()->route('EditGame');
}
    }
    //End Update Function

    //Begin  Delete Game Function
    public function Delete(Request $req){

        $Game=Game::find($req->id);
//Delete photo from public File
        File::delete("Images/" . $Game->photo);

        File::delete("Game_Files/" . $Game->link);
            $delegame=$Game->Delete();

        if ($delegame) {
            return response()->json(["status" =>true,
        'msg'=>__('messages.Game Deleted'),
        'id'=>$req->id]);
        } else {
            return response()->json(['status' =>false,
        'Msg'=>__('messages.Game Not Added')]);

        }

    }

    public function Suggestions(){

        // $Sugg=DB::select("SELECT suggestions.*,games.game_name_en AS Name,users.user_name
        // As USERNAME FROM Suggestions INNER JOIN games ON games.id=suggestions.Game_id
        // INNER JOIN users ON users.id=suggestions.User_id  ORDER BY suggestions.created_at DESC Limit 10");
        $Sugg=Suggestion::with('User')->with('Game')->WhereHas('Game',function($q){
            $q->select(['game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',]);
        })->OrderBy('id','Desc')->get();
 return view('Interfaces/Suggestions',compact('Sugg'));
    }


    public function Users(){

        $users=User::get();
 return view('Interfaces/Users',compact('users'));
    }


    public function adminserach(Request $req){
    $gameser=" ";
    if(! empty($gameser)){
    $gameser = Game::select('id',
        'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
        'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
        'photo')->where(DB::raw('concat(game_name_ar," ",game_name_en)') , 'LIKE' , '%' . $req->serach . '%')->get();
    }else{
        $gameser = Game::select(
            'id',
            'game_name_' . LaravelLocalization::getCurrentLocale() . ' as Game_Name',
            'game_details_' . LaravelLocalization::getCurrentLocale() . ' as Game_Details',
            'game_category_' . LaravelLocalization::getCurrentLocale() . ' as game_category',
            'photo',
            
        )->paginate(5);
    }
    return view('Interfaces.AllGames',compact('gameser'));
}
}
