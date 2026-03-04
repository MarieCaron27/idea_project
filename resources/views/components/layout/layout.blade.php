<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Idea</title>

        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-background text-foreground">
        <x-layout.nav />

        <main class="max-w-7x1 mx-auto px-6">
            {{ $slot }}
        </main>
    </body>
</html>
