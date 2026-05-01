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