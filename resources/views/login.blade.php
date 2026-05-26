@extends('layouts.base')

@section('title')
Connexion
@endsection

@section('content')

<div class="login-wrapper">

    <div class="login-card">

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="login-form">
            @csrf
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Identifiant"
                class="login-input"
                autofocus
            >
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Mot de passe"
                class="login-input"
            >
            <button type="submit" class="login-btn">
                Connexion
            </button>
        </form>

    </div>

    <a href="{{ route('mobile') }}" class="login-link">
        Télécharger l'application mobile
    </a>

</div>

@endsection