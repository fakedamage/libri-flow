<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libri Flow</title>
    @vite('resources/js/app.js') {{-- Importa o Vue via Vite --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div id="app">
    </div> {{-- O Vue será montado aqui --}}
</body>

</html>
