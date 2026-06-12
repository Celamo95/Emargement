@extends('layouts.base')

@section('title')
Ma formation
@endsection

@section('content')

<h1>Détails de la formation</h1>

<p>
    NOM DE LA FORMATION : {{ $formation->name}}
    <br>
    @foreach ($matieres as $matiere)
    
    <p>Cours : {{ $matiere->nom}}</p>

    @endforeach

    <a href="{{ route('formations.edit', $formation->id)}}">Modifier</a>

    <form method="POST" action="{{ route('formations.destroy', $formation->id)}}">
    @csrf
    @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
    
    
</p>

@endsection