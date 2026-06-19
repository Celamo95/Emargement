<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>État de présence — {{ $apprenant->name }} {{ $apprenant->firstname }}</title>
    <link rel="stylesheet" href="{{ asset('css/export.css') }}">
</head>

<body>

    <button class="btn-print" onclick="window.print()">Imprimer / Enregistrer en PDF</button>

    <img src="{{ asset('image/Groupe-GEFOR.png') }}" alt="Logo GEFOR" class="logo">

    <h1>État de présence mensuel</h1>

    <div class="infos">
        <p><strong>Apprenant :</strong> {{ $apprenant->name }} {{ $apprenant->firstname }}</p>
        <p><strong>Mois :</strong> {{ \Carbon\Carbon::createFromFormat('Y-m', $mois)->locale('fr')->isoFormat('MMMM YYYY') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Matière</th>
                <th>Horaires</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presences as $presence)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($presence->cours->date)->format('d/m/Y') }}</td>
                    <td>{{ $presence->cours->matiere->nom ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($presence->cours->heure_debut)->format('H\hi') }} - {{ \Carbon\Carbon::parse($presence->cours->heure_fin)->format('H\hi') }}</td>
                    <td>
                        @if($presence->statut === 'present')
                            <span class="present">Présent</span>
                        @else
                            <span class="absent">Absent</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune présence enregistrée pour ce mois.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top:30px; font-size:0.85rem; color:#6b7280;">
        Document généré le {{ \Carbon\Carbon::now()->format('d/m/Y') }} — Centre de formation GEFOR
    </p>

</body>
</html>