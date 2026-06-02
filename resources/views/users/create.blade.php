@extends('layouts.base')

@section('title')
Création utilisateur
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')

<h1>Création d'un utilisateur</h1>
<br><br>

<form method='POST' action='{{route('user.store')}}'>
@csrf
<ul>
    <li>
        <label for='name'>Nom :</label>
        <input type='text' id='name' name='name' autofocus autocomplete="name">
    </li><br>

    <li>
        <label for='firstname'>Prénom :</label>
        <input type='text' id='firstname' name='firstname' autocomplete="given-name">
    </li><br>

    <li>
        <label for='email'>Email :</label>
        <input type='email' id='email' name='email'autocomplete='email'>
    </li><br>

    <li>
        <label for='password'>Mot de passe :</label>
        <input type='password' id='password' name='password'autocomplete='password'>
    </li><br>


    <li>
        <label for='statut'>Rôle :</label>
        <select name="statut" id="statut">
            <option value="">--Choisir une option--</option>
            <option value="apprenant">Apprenant</option>
            <option value="formateur">Formateur</option>
            <option value="administration">Administration</option>
        </select>
    </li><br>

    <li>
        <button type="submit">Créer</button>
    </li>
</ul>
</form>

@endsection
