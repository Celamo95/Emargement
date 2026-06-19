@extends('layouts.base')

@section('title')
Export mensuel
@endsection

@section('content')

<h1 class="page-title">Export mensuel des présences</h1>

<div class="content-card" style="max-width:500px;">
    <form method="GET" action="" id="export-form">

        <div class="form-group">
            <label class="form-label">Apprenant</label>
            <select class="form-input" name="apprenant_id" id="apprenant_id">
                <option value="">-- Sélectionner --</option>
                @foreach($apprenants as $apprenant)
                    <option value="{{ $apprenant->id }}">{{ $apprenant->name }} {{ $apprenant->firstname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Mois</label>
            <input class="form-input" type="month" name="mois" id="mois">
        </div>

        <button type="button" class="btn-primary" onclick="genererExport()">Générer l'export</button>
    </form>
</div>

@push('scripts')
<script>
    function genererExport() {
        const apprenantId = document.getElementById('apprenant_id').value;
        const mois = document.getElementById('mois').value;

        if (!apprenantId || !mois) {
            alert('Veuillez sélectionner un apprenant et un mois.');
            return;
        }

        // Ouvre la page d'export dans un nouvel onglet
        window.open(`/export/${apprenantId}/${mois}`, '_blank');
    }
</script>
@endpush

@endsection