@extends('layouts.base')

@section('title')
Modifier une formation
@endsection


@section('content')

<h1>Modification d'une formation</h1>
<br><br>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form method='POST' action='{{route('formations.update',$formation->id)}}'>
@csrf
@method('PUT')
<ul>
    <li>
        <label for='name'>Nom :</label>
        <input type='text' id='name' name='name' value="{{$formation->name}}" autofocus autocomplete='name'>
    </li><br>

        <label for='matieres'>Matières :</label>
            <select name="matieres[]" multiple>
            @foreach ($matieres as $matiere)
                <option value="{{ $matiere->id }}" {{ in_array($matiere->id, $matieresLiees) ? 'selected' : '' }}>
            {{ $matiere->nom }}
                </option>
            @endforeach
            </select>

    <br>
    <li>
        <button type="submit">Modifier</button>
    </li>
</ul>
</form>

@endsection