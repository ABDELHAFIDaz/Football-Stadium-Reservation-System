<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALLe – @yield('title', 'Book Your Pitch')</title>
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

<body class="bg-ink text-white">

    <!-- NAV -->
    <nav class="sticky top-0 z-50 flex items-center justify-between px-10 h-[64px] bg-ink/90 backdrop-blur-2xl border-b border-neon/10">
        <a href="{{ route('home') }}" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>

        @hasSection('breadcrumb')
        <div class="flex items-center gap-2 text-sm text-white/40">
            @yield('breadcrumb')
        </div>
        @endif

        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="text-white/40 text-xs font-medium tracking-wide px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Home</a>
            <a href="{{ route('pitches') }}" class="text-white/40 text-xs font-medium tracking-wide px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Pitches</a>
            @auth
            <a href="{{ route('user.dashboard') }}" class="text-white/40 text-xs font-medium tracking-wide px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Dashboard</a>
            <a href="{{ route('logout') }}" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Sign out</a>
            @else
            <a href="{{ route('login.page') }}" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Sign in</a>
            <a href="{{ route('signup') }}" class="bg-neon text-ink font-syne font-bold text-xs tracking-widest px-4 py-2.5 rounded-lg hover:opacity-90 transition-all">Get Started</a>
            @endauth
        </div>
    </nav>

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
    @yield('content')

    @yield('scripts')

</body>

</html>