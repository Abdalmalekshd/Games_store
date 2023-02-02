<?php

namespace App\Http\Controllers\GamesControllers;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Traits\GameLinkTrait;
use App\Traits\GamePhotoTrait;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\GameRequest;
use App\Models\Admin;
use App\Models\Suggestion;
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
            // 'admin_id'        => ,
        ]);


        if ($games) {
            return Redirect()->back()->with('success', 'Game Has Been Added');
        } else {
            return Redirect()->back()->with('Error', 'Some Thing Wrong');

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
            'rating'
        )->get();
        // if(notNullValue($Games)){
        return view('interfaces/AllGames', compact('Games'));
    // }
    // else{
    //     return 'There Is No Games Go And Add One';

    // }
    }
    //End Select All Game Function

    //Begin Update Function
public function Edit($Game_id){

        $Game=Game::select()->find($Game_id);


// if(isNull($Game)){
//  return redirect()->route('AllGames');

// }else{
    return view('Interfaces/update',compact('Game'));

//  }
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
    return redirect()->back()->with('success','Game Has Been Updated');
}else{
    return redirect()->back()->with('Error','Game Has Not Been Updated');
}
    }
    //End Update Function

    //Begin  Delete Game Function
    public function Delete($Game_id){

        $Game=Game::find($Game_id);
//Delete photo from public File
        File::delete("Images/" . $Game->photo);

        File::delete("Game_Files/" . $Game->link);
            $delegame=$Game->Delete();


        return redirect()->back()->with('success','Game Has Been Deleted');


    //     return redirect()->back()->with('Error','Game Does Not Exist');


    }

    public function Suggestions(){

           $Sugg=DB::select("SELECT suggestions.*,games.game_name_en AS Name,users.user_name
           As USERNAME FROM Suggestions INNER JOIN games ON games.id=suggestions.Game_id
           INNER JOIN users ON users.id=suggestions.User_id  ORDER BY suggestions.created_at DESC Limit 10");

 return view('Interfaces/Suggestions',compact('Sugg'));
    }

}
