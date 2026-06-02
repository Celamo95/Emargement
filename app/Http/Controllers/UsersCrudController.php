<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersCrudController extends Controller
{
    public function index()
    {

        $users = User::with('formation')->get();
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('users.index'));
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'statut' => ['required'],
        ]);

        User::create($validate);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }
}
