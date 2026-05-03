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

@include('layouts.navbar')

@section('content')

<div class="flex">

  <!-- MAIN CONTENT -->
  <main class="flex-1 px-8 py-8">

    <!-- Top bar -->
    <div class="flex items-center justify-between mb-6">
      <div>
        @if(count($stadiums) === 0)
        <h1 class="font-syne font-bold text-lg text-white">
          Nothing At The Moment!
        </h1>
        @else
        <h1 class="font-syne font-bold text-lg text-white">Available Pitches</h1>
        <p class="text-[.78rem] text-white/35 mt-0.5">{{ $stadiums->count() }} pitches found</p>
        @endif
      </div>

      <form method="GET" class="flex items-center gap-3">

        <span class="text-xs text-white/35">Sort by:</span>
        <select name="sort" onchange="this.form.submit()"
          class="bg-card border border-neon/10 rounded-lg px-3 py-2 text-white/70 text-xs outline-none focus:border-neon/30 transition-all">

          <option value="">Default</option>
          <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
          <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>

        </select>

        <span class="text-xs text-white/35">City:</span>
        <select name="city" onchange="this.form.submit()"
          class="bg-card border border-neon/10 rounded-lg px-3 py-2 text-white/70 text-xs outline-none focus:border-neon/30 transition-all">

          <option value="all">All Cities</option>
          @foreach($cities as $city)
          <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
            {{ $city->name }}
          </option>
          @endforeach

        </select>

      </form>
    </div>

    <!-- PITCH GRID -->
    <div class="grid grid-cols-3 gap-5">

      @foreach($stadiums as $stadium)
      <div class="group bg-card border border-neon/10 rounded-2xl overflow-hidden hover:border-neon/25 transition-all hover:-translate-y-0.5">

        <div class="relative h-44 
    @if($stadium->status === 'unavailable') bg-gradient-to-br from-[#1f1a0a] to-[#1a150a]
    @else bg-gradient-to-br from-[#0a2015] to-[#0c1f18] @endif">

          <div class="absolute inset-0 field-grid opacity-70"></div>

          <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[.62rem] font-syne font-bold tracking-wider uppercase
      @if($stadium->status === 'unavailable')  bg-red-500 text-white
      @else bg-neon text-ink @endif">
            {{ $stadium->status }}
          </div>

          <div class="absolute inset-0 flex items-center justify-center text-6xl opacity-10">🏟️</div>
          <div class="absolute top-3 right-3 bg-ink/70 text-white text-[.62rem] font-semibold px-2 py-1 rounded-full backdrop-blur-sm border border-white/5">
            {{ $stadium->capacity / 2 }}-a-side
          </div>
        </div>

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

          <div class="flex items-center justify-end mt-4 pt-3 border-t border-neon/5">
            <div class="font-syne text-sm text-white truncate mr-auto">{{ $stadium->city->name }}</div>
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