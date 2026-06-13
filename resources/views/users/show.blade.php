@extends('layouts.base')

@section('title')
Utilisateur
@endsection

@section('content')

<h1 class="page-title">Détails de l'utilisateur</h1>

<div class="content-card">
    <div class="form-group">
        <span class="detail-label">Nom</span>
        <span class="detail-value">{{ $user->name }}</span>
    </div>
    <div class="form-group">
        <span class="detail-label">Prénom</span>
        <span class="detail-value">{{ $user->firstname }}</span>
    </div>
    <div class="form-group">
        <span class="detail-label">Email</span>
        <span class="detail-value">{{ $user->email }}</span>
    </div>
    <div class="form-group">
        <span class="detail-label">Formation</span>
        <span class="detail-value">{{ $user->formation->name ?? 'N/A' }}</span>
    </div>
    <div class="form-group">
        <span class="detail-label">Statut</span>
        <span class="detail-value">{{ $user->statut }}</span>
    </div>

    <div style="display:flex; gap:12px; margin-top:16px;">
        <a href="{{ route('user.edit', ['id'=>$user->id]) }}" class="btn-primary">Modifier</a>
        <a href="{{ route('user.delete', ['id'=>$user->id]) }}" class="btn-danger">Supprimer</a>
    </div>
</div>

@endsection