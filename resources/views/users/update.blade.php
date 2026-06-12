@extends('layouts.base')

@section('title')
Modifier un utilisateur
@endsection

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

@section('content')

<h1>Création d'un utilisateur</h1>
<br><br>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form method='POST' action='{{route('user.update',['id'=>$user->id])}}'>
@csrf
@method('PUT')
<ul>
    <li>
        <label for='name'>Nom :</label>
        <input type='text' id='name' name='name' value="{{$user->name}}" autofocus autocomplete='name'>
    </li><br>

    <li>
        <label for='firstname'>Prénom :</label>
        <input type='text' id='firstname' name='firstname' value="{{$user->firstname}}" autocomplete='given-name'>
    </li><br>

    <li>
        <label for='email'>Email :</label>
        <input type='email' id='email' name='email' value="{{$user->email}}" autocomplete='email'>
    </li><br>

    <li>
        <label for='password'>Mot de passe :</label>
        <input type='password' id='password' name='password' autocomplete='off'>
    </li><br>



    <li>
        <button type="submit">Modifier</button>
    </li>
</ul>
</form>

@endsection