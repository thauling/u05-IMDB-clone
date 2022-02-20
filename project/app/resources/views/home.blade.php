<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB Landing Page</title>
</head>

<body>
    <section class="message">
        @if (session()->has('success'))
        <section x-data="{ show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <!-- need to import alpine for this to work -->
            <p>{{ session()->get('success') }}</p>
        </section>
        @endif
    </section>
    <ul>
        <! -- href="route_defined_in_web.php" -->
            <li><a href="/register">Register new user</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/logout">Logout</a></li>
    </ul>
</body>

</html>