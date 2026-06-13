@extends('layouts.base')

@section('title')
Utilisateurs
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
<script>
    var table = new DataTable('#table', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.8/i18n/fr-FR.json',
        },
    });
</script>
@endsection

@section('content')

<h1 class="page-title">Liste des utilisateurs</h1>

<a href='{{ route('user.create') }}' class="btn-primary" style="margin-bottom: 16px;">Ajouter un utilisateur</a>

<div class="content-card">
    <table id="table" class="data-table">
        <thead>
            <tr>
                <th>Formation</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->formation->name ?? 'N/A' }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->statut }}</td>
                <td style="display:flex; gap:8px;">
                    <a href="{{ route('user.show', ['id'=>$user->id]) }}" class="btn-primary">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection