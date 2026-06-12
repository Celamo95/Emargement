@extends('layouts.base')

@section('title')
Création formation
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')

<h1>Création d'une formation</h1>
<br><br>

<form method='POST' action='{{route('formations.store')}}'>
@csrf
<ul>
   
    <li>
        <label for="name">Nom de la formation :</label>
        <input type="text" id="name" name="name">
        <br>
        <label for='matieres'>Ajouter des matières :</label>
            <select name="matieres[]" multiple>
        @foreach ($matieres as $matiere)
            <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
        @endforeach
            </select>   
    </li><br>

    <li>
        <button type="submit">Créer</button>
    </li>
</ul>
</form>

@endsection
