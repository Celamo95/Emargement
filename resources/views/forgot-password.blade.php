@extends('layouts.base')

@section('title')
Mot de passe oublié
@endsection

@section('content')

<div class="login-wrapper">
    <div class="login-card">

        <h1 style="text-align:center; color:#006cb1; font-size:1.3rem; font-weight:700; margin-bottom:24px;">
            Mot de passe oublié
        </h1>

        @if ($errors->any())
            <div style="color:#dc2626; margin-bottom:16px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <p style="color:#16a34a; text-align:center; margin-bottom:16px;">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('forgot.password') }}" class="login-form">
            @csrf

            <input class="login-input" type="email" name="email" placeholder="Votre email">

            <button type="submit" class="login-btn">Envoyer le lien</button>
        </form>

        <p style="text-align:center; margin-top:16px;">
            <a href="{{ route('login') }}" style="color:#006cb1;">Retour à la connexion</a>
        </p>
    </div>
</div>

@endsection