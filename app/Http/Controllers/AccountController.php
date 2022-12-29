<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // admin -> direct user account page //
    public function accountListPage(){
        $users = User::when(request('key'),function($query){
                        $query->where('name','like','%'.request('key').'%');
                       })
                       ->get();
        return view('admin.accountList.accounts',compact('users'));
    }

    // admin -> delete account //
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(["deleteStatus" => "Deleted account successfully."]);
    }


}
