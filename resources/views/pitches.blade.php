@extends('layouts.app')


@section('title', "MyDashboard")


@section('styles')
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

@endsection

@section('content')

<div class="flex">

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
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
        </select>
      </div>
    </div>

    <!-- PITCH GRID -->
    <div class="grid grid-cols-3 gap-5">

      @foreach($stadiums as $stadium)
      <div class="group bg-card border border-neon/10 rounded-2xl overflow-hidden hover:border-neon/25 transition-all hover:-translate-y-0.5">

        {{-- Card Header: Dynamic Background Gradients --}}
        <div class="relative h-44 
    @if($stadium->status === 'available') bg-gradient-to-br from-[#0a2015] to-[#0c1f18]
    @elseif($stadium->status === 'reserved') bg-gradient-to-br from-yellow-500/10 to-yellow-600/20
    @else bg-gradient-to-br from-[#1f1a0a] to-[#1a150a] @endif">

          <div class="absolute inset-0 field-grid opacity-70"></div>

          {{-- Status Badges --}}
          <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[.62rem] font-syne font-bold tracking-wider uppercase
      @if($stadium->status === 'available') bg-neon text-ink
      @elseif($stadium->status === 'reserved') bg-yellow-500 text-ink
      @else bg-red-500 text-white @endif">
            {{ $stadium->status }}
          </div>

          {{-- Visual Elements --}}
          <div class="absolute inset-0 flex items-center justify-center text-6xl opacity-10">🏟️</div>
          <div class="absolute top-3 right-3 bg-ink/70 text-white text-[.62rem] font-semibold px-2 py-1 rounded-full backdrop-blur-sm border border-white/5">
            {{ $stadium->capacity / 2 }}-a-side
          </div>
        </div>

        {{-- Card Body --}}
        <div class="p-4">
          <div class="flex items-start justify-between mb-1.5">
            <div class="max-w-[160px]">
              <div class="font-syne font-bold text-sm text-white truncate">{{ $stadium->name }}</div>
              <div class="text-[.72rem] text-white/35 mt-1 truncate">📍 {{ $stadium->address }}</div>
            </div>
            <div class="text-right">
              <div class="font-syne font-bold text-neon text-sm">{{ number_format($stadium->price_per_hour, 0) }} MAD</div>
              <div class="text-[.65rem] text-white/30">/hour</div>
            </div>
          </div>

          {{-- Action Row --}}
          <div class="flex items-center justify-end mt-4 pt-3 border-t border-neon/5">
            @auth
            @if($stadium->status !== 'not working')
            <a href="{{ route('stadium.book', $stadium->id) }}"
              class="inline-flex items-center text-[.75rem] text-neon font-bold hover:text-white transition-colors group/link">
              BOOK <span class="ml-1 group-hover/link:translate-x-1 transition-transform">→</span>
            </a>
            @endif
            @endauth
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <div class="mt-8 pagination-neon">
      {{ $stadiums->links() }}
    </div>

  </main>
</div>


@endsection