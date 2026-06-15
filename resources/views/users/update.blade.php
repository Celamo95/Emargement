@extends('layouts.base')

@section('title')
Modifier un utilisateur
@endsection

@section('content')

<h1 class="page-title">Modifier un utilisateur</h1>

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content-card" style="max-width:600px;">
    <form method='POST' action='{{ route('user.update', ['id'=>$user->id]) }}'>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for='name'>Nom</label>
            <input class="form-input" type='text' id='name' name='name' value="{{ $user->name }}" autocomplete='name'>
        </div>

        <div class="form-group">
            <label class="form-label" for='firstname'>Prénom</label>
            <input class="form-input" type='text' id='firstname' name='firstname' value="{{ $user->firstname }}" autocomplete='given-name'>
        </div>

        <div class="form-group">
            <label class="form-label" for='email'>Email</label>
            <input class="form-input" type='email' id='email' name='email' value="{{ $user->email }}" autocomplete='email'>
        </div>

       <div class="form-group">
            <label class="form-label" for='formation'>Formation</label>
            <select class="form-input" name="formation_id" id="formation">
                <option value="">-- Aucune --</option>
            @foreach($formations as $formation)
                <option value="{{ $formation->id }}" {{ $formation->id == $user->formation_id ? 'selected' : '' }}>
                {{ $formation->name }}
                </option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">Modifier</button>
    </form>
</div>

@endsection