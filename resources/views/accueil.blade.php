@extends('layouts.base')

@section('title')
Tableau de bord
@endsection

@section('content')
<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:calc(100vh - 70px); padding: 40px 20px; gap: 40px;">

    <h1 style="font-size:1.8rem; font-weight:700; color:#006cb1;">Tableau de bord — Administration</h1>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px; width:100%; max-width:900px;">

        <a href="{{ route('users.index')}}" style="background:white; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:60px 40px; display:flex; flex-direction:column; align-items:center; text-decoration:none; transition:box-shadow 0.2s;">
            <p style="font-size:1.2rem; font-weight:700; color:#006cb1;">Utilisateurs</p>
            <p style="font-size:0.875rem; color:#6b7280; margin-top:8px;">Ajouter, modifier, supprimer</p>
        </a>

        <a href="#" style="background:white; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:60px 40px; display:flex; flex-direction:column; align-items:center; text-decoration:none; transition:box-shadow 0.2s;">
            <p style="font-size:1.2rem; font-weight:700; color:#006cb1;">Classes</p>
            <p style="font-size:0.875rem; color:#6b7280; margin-top:8px;">Créer et gérer les groupes</p>
        </a>

        <a href="#" style="background:white; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:60px 40px; display:flex; flex-direction:column; align-items:center; text-decoration:none; transition:box-shadow 0.2s;">
            <p style="font-size:1.2rem; font-weight:700; color:#006cb1;">Emploi du temps</p>
            <p style="font-size:0.875rem; color:#6b7280; margin-top:8px;">Créer et modifier les cours</p>
        </a>

        <a href="#" style="background:white; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.08); padding:60px 40px; display:flex; flex-direction:column; align-items:center; text-decoration:none; transition:box-shadow 0.2s;">
            <p style="font-size:1.2rem; font-weight:700; color:#006cb1;">États mensuels</p>
            <p style="font-size:0.875rem; color:#6b7280; margin-top:8px;">Exporter les présences en PDF</p>
        </a>

    </div>
</div>
@endsection
