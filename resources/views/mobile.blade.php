@extends('layouts.base-mobile')

@section('title')
Télécharger l'application mobile
@endsection

@section('content')
<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:calc(100vh - 70px); gap:24px; text-align:center; padding:40px 20px;">

    <img src="{{ asset('image/Groupe-GEFOR.png') }}" alt="Logo GEFOR" style="height:40px; width:auto;">

    <h2 style="font-size:1.5rem; font-weight:700; color:#006cb1;">Application mobile GEFOR</h2>

    <p style="color:#6b7280; max-width:400px;">Téléchargez l'application mobile pour gérer vos émargements depuis votre smartphone Android.</p>

    <a href="{{ asset('app-release.apk') }}" download style="background:#006cb1; color:white; padding:14px 36px; border-radius:10px; text-decoration:none; font-weight:600; font-size:1rem;">
        Télécharger l'application
    </a>

</div>
@endsection