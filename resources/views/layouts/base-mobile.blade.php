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
</head>

<body style="background:#f0f4ff; min-height:100vh; display:flex; flex-direction:column;">
    @yield('content')
</body>

</html>