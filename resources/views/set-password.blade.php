@extends('layouts.base')

@section('title')
Créer mon mot de passe
@endsection

@section('content')

<h1>Créer mon mot de passe</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

{{-- Le formulaire envoie en POST avec le token et l'email en champs cachés --}}
{{-- L'utilisateur ne les voit pas mais ils sont envoyés avec le formulaire --}}
<form method="POST" action="{{ route('set.password') }}">
    @csrf
    
    {{-- On récupère le token et l'email depuis l'URL et on les met en hidden --}}
    {{--old recupere les valeurs precedentes apres une erreur de validation--}}
    <input type="hidden" name="token" value="{{ old('token', $token) }}">
    <input type="hidden" name="email" value="{{ old('email', $email) }}">
        
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password">

    <label for="password_confirmation">Confirmer le mot de passe :</label>
    <input type="password" id="password_confirmation" name="password_confirmation">

    <button type="submit">Valider</button>
</form>

@endsection