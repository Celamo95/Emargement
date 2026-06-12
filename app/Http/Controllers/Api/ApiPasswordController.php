<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ApiPasswordController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validate = $request->validate([
            'password' => ['required', 'confirmed', Password::min(12)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => ['required'],
        ]);

        $user->update([
            'password' => $request->password,
        ]);

        return response()->json($user);
    }
}
