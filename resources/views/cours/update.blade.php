@extends('layouts.base')

@section('title')
Modifier un cours
@endsection

@section('content')

<h1 class="page-title">Modifier un cours</h1>

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content-card" style="max-width:600px;">
    <form method="POST" action="{{ route('emploi-du-temps.update', $cours->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Formation</label>
            <select class="form-input" name="formation_id" id="formation">
                <option value="">-- Sélectionner --</option>
                @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ $formation->id == $cours->formation_id ? 'selected' : '' }}>
                        {{ $formation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Matière</label>
            <select class="form-input" name="matiere_id" id="matiere">
                <option value="">-- Sélectionner --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $matiere->id == $cours->matiere_id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Date</label>
            <input class="form-input" type="date" name="date" id="date" value="{{ $cours->date }}">
        </div>

        <div class="form-group">
            <label class="form-label">Heure de début</label>
            <input class="form-input" type="time" name="heure_debut" id="debut" value="{{ $cours->heure_debut }}">
        </div>

        <div class="form-group">
            <label class="form-label">Heure de fin</label>
            <input class="form-input" type="time" name="heure_fin" id="fin" value="{{ $cours->heure_fin }}">
        </div>

        <div class="form-group">
            <label class="form-label">Salle</label>
            <input class="form-input" type="text" name="salle" id="salle" value="{{ $cours->salle }}">
        </div>

        <div class="form-group">
            <label class="form-label">Formateur</label>
            <select class="form-input" name="user_id" id="formateur">
                <option value="">-- Sélectionner --</option>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}" {{ $formateur->id == $cours->user_id ? 'selected' : '' }}>
                        {{ $formateur->name }} {{ $formateur->firstname }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">Modifier</button>
    </form>
</div>

@endsection