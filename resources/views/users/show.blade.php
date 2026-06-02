@extends('layouts.base')

@section('title')
Mon utilisateur
@endsection

@section('content')

<h1>Renseignements utilisateur</h1>

<p>
    NOM : {{ $user->name}}
    <br>
    PRENOM : {{ $user->firstname}}
    <br>
    EMAIL : {{ $user->email}}
    <br>
    FORMATION :{{ $user->formation->name ?? 'N/A' }}
    <br>
    STATUT : {{ $user->statut}}
</p>

@endsection