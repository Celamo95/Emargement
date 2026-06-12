@extends('layouts.base')

@section('title')
Détails de la matière
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')
    
 <h1>Modification d'une matière</h1>
<br><br>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form method='POST' action='{{ route('matieres.update', $matiere->id) }}'>
@csrf
@method('PUT')
<ul>
    <li>
        <label for='nom'>Nom :</label>
        <input type='text' id='nom' name='nom' value="{{ $matiere->nom }}">
    </li>

    <li>
        <label for='formateur'>Formateur :</label>
        <select name="user_id" id="formateur">
            @foreach ($formateurs as $formateur)
                <option value="{{ $formateur->id }}"
                    {{ $formateur->id == $matiere->user_id ? 'selected' : '' }}>
                    {{ $formateur->name }} {{ $formateur->firstname }}
                </option>
            @endforeach
        </select>
    </li>

    <li>
        <button type="submit">Modifier</button>
    </li>
</ul>
</form>

@endsection