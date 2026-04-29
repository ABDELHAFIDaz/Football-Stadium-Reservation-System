<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BALLe – Browse Pitches</title>
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

    .field-grid {
      background-image: linear-gradient(rgba(61, 255, 122, .03) 1px, transparent 1px), linear-gradient(90deg, rgba(61, 255, 122, .03) 1px, transparent 1px);
      background-size: 60px 60px;
    }

    .filter-check input:checked+span {
      background: #3DFF7A;
      border-color: #3DFF7A;
    }

    .filter-check input:checked+span::after {
      content: '✓';
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #060A07;
      font-size: .6rem;
      font-weight: 900;
    }
  </style>
</head>

<body class="bg-ink text-white">

  <!-- NAV -->
  <nav class="sticky top-0 z-50 flex items-center justify-between px-10 h-[64px] bg-ink/90 backdrop-blur-2xl border-b border-neon/10">
    <a href="home.html" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>
    <div class="flex-1 mx-10">
      <div class="relative max-w-[480px]">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/30 text-sm">🔍</span>
        <input type="text" placeholder="Search pitches by name or city…" class="w-full bg-surface border border-neon/10 rounded-xl pl-10 pr-4 py-2.5 text-white text-sm outline-none placeholder-white/25 focus:border-neon/35 transition-all">
      </div>
    </div>
    <div class="flex items-center gap-2">
      @guest
      <a href="{{ route('login.page') }}" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Sign in</a>
      <a href="{{ route('signup') }}" class="bg-neon text-ink font-syne font-bold text-xs tracking-widest px-4 py-2.5 rounded-lg hover:opacity-90 transition-all">Get Started</a>
      @endguest
      @auth
      <a href="{{ route('logout') }}" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Logout</a>
      @endauth
    </div>
  </nav>

  <div class="flex min-h-[calc(100vh-64px)]">

    <!-- SIDEBAR FILTERS -->
    <aside class="w-[260px] flex-shrink-0 border-r border-neon/10 bg-surface px-6 py-8 sticky top-[64px] h-[calc(100vh-64px)] overflow-y-auto">
      <div class="font-syne font-bold text-sm text-white mb-6">Filters</div>

      <!-- CITY -->
      <div class="mb-7">
        <div class="text-[.7rem] text-white/40 uppercase tracking-widest font-semibold mb-3">City</div>
        <select class="w-full bg-card border border-neon/10 rounded-xl px-3 py-2.5 text-white/70 text-sm outline-none focus:border-neon/35 transition-all">
          <option>All Cities</option>
          @foreach($cities as $city)
          <option>{{ $city->name }}</option>
          @endforeach
          <!-- <option>Rabat</option>
          <option>Marrakech</option>
          <option>Fes</option>
          <option>Tanger</option> -->
        </select>
      </div>

      <!-- DATE -->
      <div class="mb-7">
        <div class="text-[.7rem] text-white/40 uppercase tracking-widest font-semibold mb-3">Date</div>
        <input type="date" class="w-full bg-card border border-neon/10 rounded-xl px-3 py-2.5 text-white/70 text-sm outline-none focus:border-neon/35 transition-all">
      </div>

      <!-- CAPACITY -->
      <div class="mb-7">
        <div class="text-[.7rem] text-white/40 uppercase tracking-widest font-semibold mb-3">Format</div>
        <div class="flex flex-col gap-2">
          <label class="filter-check flex items-center gap-3 cursor-pointer"><input type="checkbox" class="sr-only"><span class="relative w-4 h-4 rounded border border-neon/20 bg-card flex-shrink-0 transition-all"></span><span class="text-sm text-white/50">5-a-side</span></label>
          <label class="filter-check flex items-center gap-3 cursor-pointer"><input type="checkbox" class="sr-only"><span class="relative w-4 h-4 rounded border border-neon/20 bg-card flex-shrink-0 transition-all"></span><span class="text-sm text-white/50">7-a-side</span></label>
          <label class="filter-check flex items-center gap-3 cursor-pointer"><input type="checkbox" class="sr-only"><span class="relative w-4 h-4 rounded border border-neon/20 bg-card flex-shrink-0 transition-all"></span><span class="text-sm text-white/50">11-a-side</span></label>
        </div>
      </div>

      <button class="w-full bg-neon text-ink font-syne font-bold text-xs tracking-wider py-3 rounded-xl hover:opacity-90 transition-opacity">Apply Filters</button>
      <button class="w-full text-white/30 text-xs py-2 mt-2 hover:text-white/60 transition-colors">Reset all</button>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 px-8 py-8">
      <!-- Top bar -->
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="font-syne font-bold text-lg text-white">Available Pitches</h1>
          <p class="text-[.78rem] text-white/35 mt-0.5">{{ $stadiums->count() }} pitches found</p>
        </div>
        <div class="flex items-center gap-3">
          <span class="text-xs text-white/35">Sort by:</span>
          <select class="bg-card border border-neon/10 rounded-lg px-3 py-2 text-white/70 text-xs outline-none focus:border-neon/30 transition-all">
            <!-- <option>Relevance</option> -->
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <!-- <option>Rating</option> -->
            <!-- <option>Nearest</option> -->
          </select>
        </div>
      </div>

      <!-- PITCH GRID -->
      <div class="grid grid-cols-3 gap-5">

        @foreach($stadiums as $stadium)

        <a href="pitch-detail.html" class="group bg-card border border-neon/10 rounded-2xl overflow-hidden hover:border-neon/25 transition-all hover:-translate-y-0.5">
          <div
            @if($stadium->status === 'available')
            class="relative h-44" style="background:linear-gradient(135deg,#0a2015 0%,#0c1f18 100%)"

            @elseif($stadium->status === 'reserved')
            class="relative h-44" style="background:linear-gradient(135deg,#FFFF99 0%,#FFFF66 100%)"

            @else
            class="relative h-44" style="background:linear-gradient(135deg,#1f1a0a 0%,#1a150a 100%)">

            @endif
            >

            <div class="absolute inset-0 field-grid opacity-70"></div>
            @if($stadium->status === 'available')
            <div class="absolute inset-0 flex items-center justify-center text-6xl opacity-15">🏟️</div>
            <div class="absolute top-3 left-3 bg-neon text-ink text-[.62rem] font-syne font-bold px-2 py-1 rounded-full">Available</div>
            @elseif($stadium->status === 'reserved')
            <div class="absolute inset-0 flex items-center justify-center text-6xl opacity-15">🏟️</div>
            <div class="absolute top-3 left-3 bg-yellow-500/90 text-ink text-[.62rem] font-syne font-bold px-2 py-1 rounded-full">Reserved</div>
            @else
            <div class="absolute inset-0 flex items-center justify-center text-6xl opacity-15">🏟️</div>
            <div class="absolute top-3 left-3 bg-red-500/90 text-white text-[.62rem] font-syne font-bold px-2 py-1 rounded-full">Not Working</div>
            @endif
            <div class="absolute top-3 right-3 bg-ink/70 text-white text-[.62rem] font-semibold px-2 py-1 rounded-full backdrop-blur-sm">{{ $stadium->capacity / 2 }}-a-side</div>
            <!-- <div class="absolute bottom-3 left-3 flex gap-1.5">
              <span class="bg-ink/60 text-white/70 text-[.6rem] px-2 py-0.5 rounded-full backdrop-blur-sm">🌿 Grass</span>
              <span class="bg-ink/60 text-white/70 text-[.6rem] px-2 py-0.5 rounded-full backdrop-blur-sm">💡 Floodlit</span>
            </div> -->
          </div>
          <div class="p-4">
            <div class="flex items-start justify-between mb-1.5">
              <div>
                <div class="font-syne font-bold text-sm text-white">{{ $stadium->name }}</div>
                <div class="text-[.72rem] text-white/35 mt-0.5">📍 {{ $stadium->address }}</div>
              </div>
              <div class="text-right">
                <div class="font-syne font-bold text-neon text-sm">{{ $stadium->price_per_hour }} MAD</div>
                <div class="text-[.65rem] text-white/30">/hour</div>
              </div>
            </div>
            <div class="flex items-center gap-3 mt-3 pt-3 border-t border-neon/10">
              <!-- <span class="text-[.7rem] text-yellow-400">★ 4.8</span>
            <span class="text-[.7rem] text-white/30">·</span>
            <span class="text-[.7rem] text-white/35">24 reviews</span> -->
              <a href="{{ route('stadium.book', $stadium->id) }}" class="ml-auto text-[.7rem] text-neon font-semibold">Book →</a>
            </div>
          </div>
        </a>

        @endforeach

      </div>

      <!-- PAGINATION -->
      <!-- <div class="flex items-center justify-center gap-2 mt-10">
      <button class="w-9 h-9 rounded-lg bg-neon text-ink font-syne font-bold text-sm">1</button>
      <button class="w-9 h-9 rounded-lg bg-card border border-neon/10 text-white/50 text-sm hover:border-neon/25 hover:text-white transition-all">2</button>
      <button class="w-9 h-9 rounded-lg bg-card border border-neon/10 text-white/50 text-sm hover:border-neon/25 hover:text-white transition-all">3</button>
      <span class="text-white/25 text-sm px-2">…</span>
      <button class="w-9 h-9 rounded-lg bg-card border border-neon/10 text-white/50 text-sm hover:border-neon/25 hover:text-white transition-all">8</button>
    </div> -->
    </main>
  </div>
</body>

</html>