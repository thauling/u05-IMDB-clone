<!DOCTYPE html>
<html lang="en">
@include('_head')

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-300">
        @include('layouts.navigation')

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>