@extends('layouts.base')

@section('title')
Connexion
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush
@section('content')

{{-- Show a generic error message if needed --}}
    @if (session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

<div class="form-container">
    <form method="POST" action="{{ route('login.post') }}" class="form">
        @csrf

        <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="Identifiant" 
        autofocus
        >

        <input 
        type="password" 
        id="password" 
        name="password" 
        placeholder="Mot de passe"
        >

        <button type="submit">Connexion</button>

    </form>
</div>
@endsection