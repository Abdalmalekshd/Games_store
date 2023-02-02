<?php

namespace App\Http\Controllers\GamesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ManageAccountController extends Controller
{
   // Get Manage Account Page
   public function ManageAccount(){
    $user=User::find(session('user_id'));
    if($user){
  return view('Interfaces/MyAccount',compact('user'));
}else{
    return view('Interfaces/login');

}
}



// Update Account Info Page
public function UpdateAcc(Request $request){
    $user=User::find(session('user_id'));
   $user->update([
'name'=>$request->full_name,
'email'=>$request->email,
'user_name'=>$request->user_name,
]);
return redirect()->back()->with('success','Info Has Been Updated');
  }
}
