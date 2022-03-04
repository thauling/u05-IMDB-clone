<?php
$logo = asset('assets/images/imdb_logo.png');
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- include tailwind via CDN for testing, change this to local installation later  -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="/css/output.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- also include alpine and hard-code version later -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <!-- <header class="bg-white shadow">
                <div class="max-w-xs mx-auto py-6 px-4 sm:px-6 lg:px-8">
                 <img class="logo" src="{{ $logo }}" alt="imdb logo" /> 
                <object data="{{ $logo }}" width="100" height="50"> </object>
                </div>
            </header> -->

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>