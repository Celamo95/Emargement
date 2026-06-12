@extends('layouts.base')

@section('title')
Modification du cours
@endsection



@section('content')

@if ($errors->any())
 @foreach ($errors->all() as $error)
 <p>{{ $error }}</p>
 @endforeach
@endif

<div>
        <h2>Mofifier le cours</h2>

    <form method="POST" action="{{ route('emploi-du-temps.update', $cours->id) }}">
@csrf
@method('PUT')

    <label for="formation">Formation</label>
    <select name="formation_id" id="formation">
        @foreach($formations as $formation)
            <option value="{{ $formation->id }}" {{ $formation->id == $cours->formation_id ? 'selected' : '' }}>
                {{ $formation->name }}
            </option>
        @endforeach
    </select>

    <label for="matiere">Matière</label>
    <select name="matiere_id" id="matiere">
        @foreach($matieres as $matiere)
            <option value="{{ $matiere->id }}" {{ $matiere->id == $cours->matiere_id ? 'selected' : '' }}>
                {{ $matiere->nom }}
            </option>
        @endforeach
    </select>

    <label for="date">Date</label>
    <input type="date" name="date" id="date" value="{{ $cours->date }}">

    <label for="debut">Heure de début</label>
    <input type="time" name="heure_debut" id="debut" value="{{ $cours->heure_debut }}">

    <label for="fin">Heure de fin</label>
    <input type="time" name="heure_fin" id="fin" value="{{ $cours->heure_fin }}">

    <label for="salle">Salle</label>
    <input type="text" name="salle" id="salle" value="{{ $cours->salle }}">

    <label for="formateur">Formateur</label>
    <select name="user_id" id="formateur">
        @foreach($formateurs as $formateur)
            <option value="{{ $formateur->id }}" {{ $formateur->id == $cours->user_id ? 'selected' : '' }}>
                {{ $formateur->name }} {{ $formateur->firstname }}
            </option>
        @endforeach
    </select>

    <button type="submit">Modifier</button>
</form>

@endsection