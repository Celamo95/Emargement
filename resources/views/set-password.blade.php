@extends('layouts.base')

@section('title')
Créer mon mot de passe
@endsection

@section('content')

<div class="login-wrapper">
    <div class="login-card">

        <h1 style="text-align:center; color:#006cb1; font-size:1.3rem; font-weight:700; margin-bottom:24px;">
            Créer mon mot de passe
        </h1>

        @if ($errors->any())
            <div style="color:#dc2626; margin-bottom:16px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('set.password') }}" class="login-form">
            @csrf
            <input type="hidden" name="token" value="{{ old('token', $token) }}">
            <input type="hidden" name="email" value="{{ old('email', urldecode($email)) }}">

            <input class="login-input" type="password" id="password" name="password" placeholder="Mot de passe">
            <input class="login-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe">

            <small style="color:#6b7280; text-align:center;">
                12 caractères minimum, majuscule, minuscule, chiffre et caractère spécial
            </small>

            <button type="submit" class="login-btn">Valider</button>
        </form>
    </div>
</div>

@endsection