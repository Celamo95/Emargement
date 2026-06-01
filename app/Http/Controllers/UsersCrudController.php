<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersCrudController extends Controller
{
    public function list(){

    $users= User::with('formation')->get();
    return view('users.list', [
        'users' => $users,
    ]);
    }

    public function delete($id){
         $user= User::findOrFail($id);
         $user->delete();

    return redirect(route('users.list'));


    }
}
