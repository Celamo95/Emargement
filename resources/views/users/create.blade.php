@extends('layouts.base')

@section('title')
Création utilisateur
@endsection

@section('content')

<h1 class="page-title">Création d'un utilisateur</h1>

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content-card" style="max-width:600px;">
    <form method='POST' action='{{ route('user.store') }}'>
        @csrf

        <div class="form-group">
            <label class="form-label" for='name'>Nom</label>
            <input class="form-input" type='text' id='name' name='name' autofocus autocomplete="name">
        </div>

        <div class="form-group">
            <label class="form-label" for='firstname'>Prénom</label>
            <input class="form-input" type='text' id='firstname' name='firstname' autocomplete="given-name">
        </div>

        <div class="form-group">
            <label class="form-label" for='email'>Email</label>
            <input class="form-input" type='email' id='email' name='email' autocomplete='email'>
        </div>

        <div class="form-group">
            <label class="form-label" for='statut'>Rôle</label>
            <select class="form-input" name="statut" id="statut">
                <option value="">-- Choisir --</option>
                <option value="apprenant">Apprenant</option>
                <option value="formateur">Formateur</option>
                <option value="administration">Administration</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Créer</button>
    </form>
</div>

@endsection