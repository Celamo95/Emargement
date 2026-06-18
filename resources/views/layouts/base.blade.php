<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="bg-[#f0f4ff] min-h-screen flex flex-col font-[Lato]">

    <header class="bg-[#006cb1] flex items-center justify-between px-8 py-4">
        <img src="{{ asset('image/Groupe-GEFOR.png') }}" alt="Logo GEFOR" class="h-10">
        <h2 class="text-white font-semibold text-lg tracking-wide">Emargement</h2>
        @auth
            <a href="{{ route('logout') }}" class="btn-logout">Se déconnecter</a>
        @else
            <div class="w-32"></div>
        @endauth
    </header>

    @auth
        @if(Auth::user()->statut === 'administration' && !in_array(request()->route()->getName(), ['accueil', 'set.password.form', 'set.password']))
        {{-- Layout avec menu latéral --}}
        <div class="admin-layout">
            <aside class="sidebar">
                <nav>
                    <a href="{{ route('accueil') }}" class="sidebar-link">Accueil</a>
                    
                    <p class="sidebar-category">Utilisateurs</p>
                    <a href="{{ route('users.index') }}" class="sidebar-link">Liste</a>
                    <a href="{{ route('user.create') }}" class="sidebar-link">Ajouter</a>

                    <p class="sidebar-category">Formations</p>
                    <a href="{{ route('formations.index') }}" class="sidebar-link">Liste</a>
                    <a href="{{ route('formations.create') }}" class="sidebar-link">Ajouter</a>

                    <p class="sidebar-category">Matières</p>
                    <a href="{{ route('matieres.create') }}" class="sidebar-link">Ajouter</a>

                    <p class="sidebar-category">Emploi du temps</p>
                    <a href="{{ route('emploi-du-temps.index') }}" class="sidebar-link">Gérer</a>

                    <p class="sidebar-category"> Présences</p>
                    <a href="{{route('presences.index')}}" class="sidebar-link">Gérer les présences et absences</a>
                    <a href="#" class="sidebar-link">Créer un export mensuel</a>

                </nav>
            </aside>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
        @else
        {{-- Layout sans menu --}}
        <main class="flex-1 flex flex-col">
            @yield('content')
        </main>
        @endif
    @else
    {{-- Non connecté --}}
    <main class="flex-1 flex flex-col">
        @yield('content')
    </main>
    @endauth

    @yield('js')
    @stack('scripts')

</body>

</html>