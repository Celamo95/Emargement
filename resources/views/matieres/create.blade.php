@extends('layouts.base')

@section('title')
Créer une matière
@endsection

@section('content')

<h1 class="page-title">Créer une matière</h1>

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content-card" style="max-width:600px;">
    <form method='POST' action='{{ route('matieres.store') }}'>
        @csrf

        <div class="form-group">
            <label class="form-label" for="nom">Nom de la matière</label>
            <input class="form-input" type="text" id="nom" name="nom">
        </div>

        <div class="form-group">
            <label class="form-label" for="formateur">Formateur</label>
            <select class="form-input" name="user_id" id="formateur">
                <option value="">-- Sélectionner --</option>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}">{{ $formateur->name }} {{ $formateur->firstname }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">Créer</button>
    </form>
</div>

@endsection