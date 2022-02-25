<?php
  $logo = asset('assets/images/imdb_logo.png');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/app.css">
  <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
  <!-- also include alpine and hard-code version later -->
  <!-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
  <title>Document</title>
</head>
<body>
  <header>
    <img class="logo" src="{{ $logo }}" alt="imdb logo" />
  </header>
  <main>
    {{ $slot }}
  </main>
  
</body>
</html>
