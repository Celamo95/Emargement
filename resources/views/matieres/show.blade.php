@extends('layouts.base')

@section('title')
Détails de la matière
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')
    
 <h1>Détails de la matière</h1>

<p>Nom : {{ $matiere->nom }}</p>
<p>Formateur : {{ $matiere->user->name ?? 'N/A' }} {{ $matiere->user->firstname ?? '' }}</p>

<a href="{{ route('matieres.edit', $matiere->id) }}">Modifier</a>

<form method="POST" action="{{ route('matieres.destroy', $matiere->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer</button>
</form>


        

@endsection
