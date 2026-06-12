@extends('layouts.base')

@section('title')
Formations
@endsection



@section('content')

<h1>Liste des formations</h1>

<a href='{{route('formations.create')}}'>Créer une formation</a>

@foreach ($formations as $formation)
    <ul>
        
        <li>{{ $formation->name }}</li>
        
        <li>
            <a href="{{ route('formations.show', $formation->id)}}">Voir</a>
            
        </li>
    </ul>
@endforeach

<hr>
<h1>Liste des matières</h1>

<a href='{{ route('matieres.create') }}'>Créer une matière</a>

@foreach ($matieres as $matiere)
    <ul>
        <li>{{ $matiere->nom }} — {{ $matiere->user->name ?? 'N/A' }}</li>
        <li>
            <a href="{{ route('matieres.show', $matiere->id) }}">Voir</a>
        </li>
    </ul>
@endforeach



 @endsection