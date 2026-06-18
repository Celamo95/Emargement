@extends('layouts.base')

@section('title')
Suivi des présences
@endsection

@section('content')

<h1 class="page-title">Suivi des présences</h1>

{{-- Filtres --}}
<div class="content-card" style="margin-bottom:24px;">
    <form method="GET" action="{{ route('presences.index') }}" style="display:flex; gap:16px; flex-wrap:wrap; align-items:flex-end;">
        
        <div class="form-group" style="margin:0;">
            <label class="form-label">Formation</label>
            <select class="form-input" name="formation_id" onchange="this.form.submit()">
                <option value="">-- Sélectionner --</option>
                @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                        {{ $formation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if($cours->count() > 0)
        <div class="form-group" style="margin:0;">
            <label class="form-label">Cours</label>
            <select class="form-input" name="cours_id" onchange="this.form.submit()">
                <option value="">-- Sélectionner --</option>
                @foreach($cours as $c)
                    <option value="{{ $c->id }}" {{ request('cours_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->matiere->nom ?? '' }} — {{ \Carbon\Carbon::parse($c->date)->format('d/m/Y')}} — {{ \Carbon\Carbon::parse($c->heure_debut)->format('H\hi') }} à {{ \Carbon\Carbon::parse($c->heure_fin)->format('H\hi') }} 
                    </option>
                @endforeach
            </select>
        </div>
        @endif

    </form>
</div>

{{-- Liste des présences --}}
@if($presences->count() > 0)
<div class="content-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Apprenant</th>
                <th>Statut</th>
                <th>Validé formateur</th>
                <th>Validé apprenant</th>
                <th>Justificatif</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presences as $presence)
            <tr>
                <td>{{ $presence->apprenant->name ?? 'N/A' }} {{ $presence->apprenant->firstname ?? '' }}</td>
                <td>
                    @if($presence->statut === 'present')
                        <span style="color:#16a34a;">Présent</span>
                    @elseif($presence->statut === 'absent')
                        <span style="color:#dc2626;">Absent</span>
                    @else
                        {{ $presence->statut }}
                    @endif
                </td>
                <td>{{ $presence->valide_formateur ? '✓' : '✗' }}</td>
                <td>{{ $presence->valide_apprenant ? '✓' : '✗' }}</td>
                <td>
                    @if($presence->justificatifs->count() > 0)
                        @foreach($presence->justificatifs as $justificatif)
                            <div style="display:flex; gap:8px; align-items:center;">
                                <a href="{{ asset('storage/' . $justificatif->fichier) }}" target="_blank" class="btn-primary" style="font-size:0.75rem; padding:4px 8px;">Voir</a>
                                <a href="{{ asset('storage/' . $justificatif->fichier) }}" download class="btn-primary" style="font-size:0.75rem; padding:4px 8px;">Télécharger</a>
                                
                                <form method="POST" action="{{ route('justificatif.update', $justificatif->id) }}">
                                    @csrf
                                    <input type="hidden" name="etat" value="accepte">
                                    <button type="submit" class="btn-primary" style="font-size:0.75rem; padding:4px 8px; background:#16a34a;">Accepter</button>
                                </form>
                                
                                <form method="POST" action="{{ route('justificatif.update', $justificatif->id) }}">
                                    @csrf
                                    <input type="hidden" name="etat" value="refuse">
                                    <button type="submit" class="btn-danger" style="font-size:0.75rem; padding:4px 8px;">Refuser</button>
                                </form>
                                
                                <span style="font-size:0.75rem; color:#6b7280;">{{ $justificatif->etat }}</span>
                            </div>
                        @endforeach
                    @else
                        <span style="color:#6b7280; font-size:0.85rem;">Aucun</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@elseif(request('cours_id'))
    <p style="color:#6b7280;">Aucune présence pour ce cours.</p>
@endif

@push('scripts')
<script>
    document.querySelector('select[name="formation_id"]').addEventListener('change', function() {
        // Quand on change la formation, on soumet sans cours_id
        const form = this.closest('form');
        const coursSelect = form.querySelector('select[name="cours_id"]');
        if (coursSelect) coursSelect.value = '';
        form.submit();
    });
</script>
@endpush

@endsection