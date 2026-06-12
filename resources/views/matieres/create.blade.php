@extends('layouts.base')

@section('title')
Création formation
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush

@section('content')

<h1>Création d'une matière</h1>
<br><br>

<form method='POST' action='{{route('matieres.store')}}'>
@csrf
<ul>
   
    <li>
        <label for="name">Nom de la matiere :</label>
        <input type="text" id="name" name="nom">

        <br>

       <label for="formateur">Nom du formateur :</label>
        <select name="user_id" id="formateur">
            @foreach($formateurs as $formateur)
                <option value="{{ $formateur->id }}">{{ $formateur->name }} {{ $formateur->firstname }}</option>
            @endforeach
        </select>
        
    </li><br>

    <li>
        <button type="submit">Créer</button>
    </li>
</ul>
</form>

@endsection
