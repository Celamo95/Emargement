@extends('layouts.base')

@section('title')
Emploi du temps
@endsection



@section('content')

@if ($errors->any())
 @foreach ($errors->all() as $error)
 <p>{{ $error }}</p>
 @endforeach
@endif


<div>
        <h2>Ajouter un cours</h2>

    <form method="POST" action="{{route('emploi-du-temps.store')}}">
    @csrf

        <label for="formation">Formation</label>
        <select name="formation_id" id="formation">

            @foreach($formations as $formation)
                <option value="{{ $formation->id }}">{{ $formation->name }}</option>
            @endforeach

        </select>

        <label for="matiere">Matière</label>
        <input type="text" name="matiere" id="matiere" list="matieres">
    
        <datalist id="matieres">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere }}">
            @endforeach
        </datalist>

        <label for="date">Date</label>
        <input type="date" name="date" id="date">

        <label for="debut">Heure de début</label>
        <input type="time" name="heure_debut" id="debut">

        <label for="fin">Heure de fin</label>
        <input type="time" name="heure_fin" id="fin">

        <label for="salle">Salle</label>
        <input type="text" name="salle" id="salle">


        <label for="formateur">Formateur</label>
        <select name="user_id" id="formateur">

            @foreach($formateurs as $formateur)
                <option value="{{ $formateur->id }}">{{ $formateur->name }} {{ $formateur->firstname }}</option>
            @endforeach

        </select>

        <button type="submit">Ajouter</button>
    </form>
</div>


<div>
 {{-- Navigation par semaine --}}
<form method="GET" action="{{ route('emploi-du-temps.index') }}">
    <a href="{{ route('emploi-du-temps.index', ['week' => $debutSemaine->copy()->subWeek()->toDateString()]) }}">← Semaine précédente</a>
    
    <span>Semaine du {{ $debutSemaine->format('d/m/Y') }} au {{ $debutSemaine->copy()->endOfWeek()->format('d/m/Y') }}</span>
    
    <a href="{{ route('emploi-du-temps.index', ['week' => $debutSemaine->copy()->addWeek()->toDateString()]) }}">Semaine suivante →</a>
</form>

<table>

<thead>
    <tr>
        <th>Jours</th>
        <th>Date</th>
        <th>Matin</th>
        <th>Salle</th>
        <th>Après-midi</th>
        <th>Salle</th>
    </tr>
</thead>

<tbody>
    @php
        $joursFr = [1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi'];
    @endphp

    @for($i = 1; $i <= 5; $i++)
        @php
            $dateJour = $debutSemaine->copy()->addDays($i - 1)->toDateString();
            $coursJour = $cours->where('date', $dateJour);
            $matin = $coursJour->filter(fn($c) => $c->heure_debut < '12:00:00')->first();
            $apmidi = $coursJour->filter(fn($c) => $c->heure_debut >= '12:00:00')->first();
        @endphp
        <tr>
            <td>{{ $joursFr[$i] }}</td>
            <td>{{ \Carbon\Carbon::parse($dateJour)->format('d/m/Y') }}</td>
            <td>{{ $matin ? $matin->matiere . ' - ' . ($matin->user->name ?? 'N/A') : '' }}</td>
            <td>{{ $matin ? $matin->salle : '' }}</td>
            <td>{{ $apmidi ? $apmidi->matiere . ' - ' . ($apmidi->user->name ?? 'N/A') : '' }}</td>
            <td>{{ $apmidi ? $apmidi->salle : '' }}</td>
        </tr>
    @endfor
</tbody> 
    

</table>
</div>
@endsection