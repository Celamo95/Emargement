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
    @yield('css')
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

    <main class="flex-1 flex flex-col">
        @yield('content')
    </main>

    @yield('js')

</body>

</html>