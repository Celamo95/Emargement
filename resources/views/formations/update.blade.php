@extends('layouts.base')

@section('title')
Modifier une formation
@endsection

@section('content')

<h1 class="page-title">Modifier une formation</h1>

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content-card" style="max-width:600px;">
    <form method='POST' action='{{ route('formations.update', $formation->id) }}'>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for='name'>Nom de la formation</label>
            <input class="form-input" type='text' id='name' name='name' value="{{ $formation->name }}">
        </div>

        <div class="form-group">
            <label class="form-label">Matières associées</label>
            <select class="form-input" name="matieres[]" multiple>
                @foreach ($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ in_array($matiere->id, $matieresLiees) ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
            <small style="color:#6b7280;">Maintenez Ctrl pour sélectionner plusieurs matières</small>
        </div>

        <button type="submit" class="btn-primary">Modifier</button>
    </form>
</div>

@endsection