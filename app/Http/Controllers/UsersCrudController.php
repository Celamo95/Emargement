<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            'statut' => ['required'],
        ]);

        $validate['password'] = bcrypt('non_defini_' . uniqid());

        User::create($validate);

        $token = \Illuminate\Support\Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => bcrypt($token),
                'created_at' => now(),
            ]
        );

        // On envoie le mail à l'utilisateur avec son email et le token non hashé
        // On passe $token et pas bcrypt($token) car l'utilisateur a besoin de la valeur originale dans l'URL
        Mail::to($request->email)->send(new SetPasswordMail($request->email, $token));

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    public function edit(int $id)
    {
        $user = User::Find($id);

        return view('users.update', ['user' => $user]);
    }

    public function update(Request $request, int $id)
    {
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'string'],
        ]);

        if (!$request->filled('password')) {
            unset($validate['password']);
        }

        User::whereId($id)->update($validate);

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié');
    }

    public function show(int $id)
    {
        $user = User::Find($id);

        return view('users.show', ['user' => $user]);
    }

    // Affiche le formulaire — reçoit token et email depuis l'URL
    public function setPasswordForm(Request $request)
    {
        return view('set-password', [
            'token' => $request->query('token'),
            'email' => $request->query('email'),
        ]);
    }

    public function setPassword(Request $request)
    {
        $validated = $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
    
        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->with('error', 'Lien invalide ou expiré.');
        }
        User::where('email', $request->email)->update([
            'password' => bcrypt($request->password),
        ]);
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Mot de passe créé, vous pouvez vous connecter.');
    }
}
