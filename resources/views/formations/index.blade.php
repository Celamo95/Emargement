@extends('layouts.base')

@section('title')
Formations & Matières
@endsection

@section('content')

<h1 class="page-title">Formations</h1>

<a href='{{ route('formations.create') }}' class="btn-primary" style="margin-bottom:16px; display:inline-block;">Créer une formation</a>

<div class="content-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formations as $formation)
            <tr>
                <td>{{ $formation->name }}</td>
                <td>
                    <a href="{{ route('formations.show', $formation->id) }}" class="btn-primary">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h1 class="page-title" style="margin-top:32px;">Matières</h1>

<a href='{{ route('matieres.create') }}' class="btn-primary" style="margin-bottom:16px; display:inline-block;">Créer une matière</a>

<div class="content-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Matière</th>
                <th>Formateur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matieres as $matiere)
            <tr>
                <td>{{ $matiere->nom }}</td>
                <td>{{ $matiere->user->name ?? 'N/A' }} {{ $matiere->user->firstname ?? '' }}</td>
                <td>
                    <a href="{{ route('matieres.show', $matiere->id) }}" class="btn-primary">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection