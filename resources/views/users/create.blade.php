@extends('layouts.base')

@section('title')
Création d'un utilisateur
@endsection

@push('styles')
@vite('resources/css/app.css')
@endpush
@section('content')

<div>
    <form method="POST" action>

        <input
        type="text"
        id="name"
        name="name"
        placeholder="Nom"
        autofocus
        >

        <input
        type="text"
        id="firstname"
        name="firstname"
        placeholder="Prénom"
        >

        <input
        type="email"
        id="email"
        name="email"
        placeholder="Email"
        >

        <input 
        type="select"
        id="statut"
        name="statut"
        placeholder="Selectionner"
        
