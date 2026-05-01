<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALLe – @yield('title', 'Football Reservation')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        neon: '#3DFF7A',
                        ink: '#060A07',
                        surface: '#0C1210',
                        card: '#131A15'
                    },
                    fontFamily: {
                        bebas: ['Bebas Neue', 'sans-serif'],
                        syne: ['Syne', 'sans-serif'],
                        dm: ['DM Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-ink text-white min-h-screen flex flex-col">

    @include('layouts.navbar')

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="mx-10 mt-4 px-4 py-3 bg-green-950 border border-green-700 text-green-400 text-sm rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mx-10 mt-4 px-4 py-3 bg-red-950 border border-red-700 text-red-400 text-sm rounded-xl">
        {{ session('error') }}
    </div>
    @endif

    <!-- PAGE CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    @yield('scripts')

</body>

</html>