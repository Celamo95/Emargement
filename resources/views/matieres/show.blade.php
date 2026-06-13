@extends('layouts.base')

@section('title')
Détails de la matière
@endsection

@vite('resources/css/app.css')


@section('content')
    
 <h1 class="page-title">Détails de la matière</h1>

 <div class="content-card">
    <div class="form-group">
        <span class="detail-label">Nom</span>
        <span class="detail-value">{{$matiere->nom}}</span>
    </div>

    <div class="form-group">
        <span class="detail-label">Formateur</span>
        <span class="detail-value">{{ $matiere->user->name ?? 'N/A' }} {{ $matiere->user->firstname ?? '' }}</span>
    </div>

    <div style="display: flex; gap:12px; margin-top:16px;">
        <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn-primary">Modifier</a>

        <form method="POST" action="{{ route('matieres.destroy', $matiere->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Supprimer</button>
        </form>
    </div>
 </div>

@endsection
