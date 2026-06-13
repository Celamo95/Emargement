@extends('layouts.base')

@section('title')
Emploi du temps
@endsection

@section('content')

@if ($errors->any())
    <div style="color:#dc2626; margin-bottom:16px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<h1 class="page-title">Emploi du temps</h1>

<div style="display:flex; gap:24px; align-items:flex-start;">

    {{-- Formulaire ajout cours --}}
    <div class="content-card" style="width:300px; flex-shrink:0;">
        <h2 style="font-size:1rem; font-weight:700; color:#006cb1; margin-bottom:16px;">Ajouter un cours</h2>

        <form method="POST" action="{{ route('emploi-du-temps.store') }}">
        @csrf

            <div class="form-group">
                <label class="form-label">Formation</label>
                <select class="form-input" name="formation_id" id="formation">
                    <option value="">-- Sélectionner --</option>
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}" {{ request('formation_id') == $formation->id ? 'selected' : '' }}>{{ $formation->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Matière</label>
                <select class="form-input" name="matiere_id" id="matiere">
                    <option value="">-- Sélectionner --</option>
                    @foreach($matieres as $matiere)
                        <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Date</label>
                <input class="form-input" type="date" name="date" id="date">
            </div>

            <div class="form-group">
                <label class="form-label">Heure de début</label>
                <input class="form-input" type="time" name="heure_debut" id="debut">
            </div>

            <div class="form-group">
                <label class="form-label">Heure de fin</label>
                <input class="form-input" type="time" name="heure_fin" id="fin">
            </div>

            <div class="form-group">
                <label class="form-label">Salle</label>
                <input class="form-input" type="text" name="salle" id="salle">
            </div>

            <div class="form-group">
                <label class="form-label">Formateur</label>
                <select class="form-input" name="user_id" id="formateur">
                    <option value="">-- Sélectionner --</option>
                    @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}">{{ $formateur->name }} {{ $formateur->firstname }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary" style="width:100%;">Ajouter</button>
        </form>
    </div>

    {{-- Tableau emploi du temps --}}
    <div style="flex:1;">
        <div class="content-card" style="margin-bottom:16px;">
            <form method="GET" action="{{ route('emploi-du-temps.index') }}" style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                <select class="form-input" name="formation_id" style="width:200px;">
                    <option value="">-- Toutes les formations --</option>
                    @foreach($formations as $formation)
                        <option value="{{ $formation->id }}" {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                            {{ $formation->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary">Filtrer</button>

                <a href="{{ route('emploi-du-temps.index', ['week' => $debutSemaine->copy()->subWeek()->toDateString(), 'formation_id' => request('formation_id')]) }}" class="btn-primary">← Précédente</a>
                <span style="font-weight:600; color:#006cb1;">Semaine du {{ $debutSemaine->format('d/m/Y') }} au {{ $debutSemaine->copy()->endOfWeek()->format('d/m/Y') }}</span>
                <a href="{{ route('emploi-du-temps.index', ['week' => $debutSemaine->copy()->addWeek()->toDateString(), 'formation_id' => request('formation_id')]) }}" class="btn-primary">Suivante →</a>
            </form>
        </div>

        <div class="content-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Jour</th>
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
                            <td>
                                @if($matin)
                                    <strong>{{ $matin->matiere->nom ?? 'N/A' }}</strong><br>
                                    <small>{{ $matin->user->name ?? 'N/A' }}</small><br>
                                    <div style="display:flex; gap:6px; margin-top:4px;">
                                        <a href="{{ route('emploi-du-temps.edit', $matin->id) }}" class="btn-primary" style="font-size:0.75rem; padding:4px 8px;">Modifier</a>
                                        <form method="POST" action="{{ route('emploi-du-temps.destroy', $matin->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" style="font-size:0.75rem; padding:4px 8px;">Supprimer</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $matin ? $matin->salle : '' }}</td>
                            <td>
                                @if($apmidi)
                                    <strong>{{ $apmidi->matiere->nom ?? 'N/A' }}</strong><br>
                                    <small>{{ $apmidi->user->name ?? 'N/A' }}</small><br>
                                    <div style="display:flex; gap:6px; margin-top:4px;">
                                        <a href="{{ route('emploi-du-temps.edit', $apmidi->id) }}" class="btn-primary" style="font-size:0.75rem; padding:4px 8px;">Modifier</a>
                                        <form method="POST" action="{{ route('emploi-du-temps.destroy', $apmidi->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" style="font-size:0.75rem; padding:4px 8px;">Supprimer</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $apmidi ? $apmidi->salle : '' }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const matieres = @json($matieres);

    document.getElementById('matiere').addEventListener('change', function() {
        const matiereId = this.value;
        const formateurSelect = document.getElementById('formateur');
        const matiere = matieres.find(m => m.id == matiereId);
        if (matiere && matiere.user) {
            formateurSelect.value = matiere.user.id;
        }
    });
</script>
@endpush

@endsection