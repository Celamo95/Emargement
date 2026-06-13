@extends('layouts.base')

@section('title')
Formation
@endsection

@section('content')

<h1 class="page-title">Détails de la formation</h1>

<div class="content-card" style="max-width:600px;">

    <div class="form-group">
        <span class="detail-label">Nom de la formation</span>
        <span class="detail-value">{{ $formation->name }}</span>
    </div>

    <div class="form-group">
        <span class="detail-label">Matières associées</span>
        @forelse ($matieres as $matiere)
            <span class="detail-value">{{ $matiere->nom }}</span>
        @empty
            <span class="detail-value">Aucune matière associée</span>
        @endforelse
    </div>

    <div style="display:flex; gap:12px; margin-top:16px;">
        <a href="{{ route('formations.edit', $formation->id) }}" class="btn-primary">Modifier</a>
        <form method="POST" action="{{ route('formations.destroy', $formation->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Supprimer</button>
        </form>
    </div>

</div>

@endsection