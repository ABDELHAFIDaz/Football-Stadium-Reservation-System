@extends('layouts.app')

@section('title', $stadium->name)

@section('breadcrumb')
<a href="{{ route('pitches') }}" class="hover:text-white transition-colors">Pitches</a>
<span>/</span>
<span class="text-white">{{ $stadium->name }}</span>
@endsection

@section('styles')
<style>
  .field-grid {
    background-image: linear-gradient(rgba(61, 255, 122, .04) 1px, transparent 1px), linear-gradient(90deg, rgba(61, 255, 122, .04) 1px, transparent 1px);
    background-size: 50px 50px;
  }
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="relative h-72 overflow-hidden" style="background:linear-gradient(135deg,#0a2015 0%,#061410 100%)">
  <div class="absolute inset-0 field-grid"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <div class="text-[10rem] opacity-10">🏟️</div>
  </div>
  <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(6,10,7,1) 0%,transparent 50%)"></div>
  <div class="absolute bottom-8 left-10">
    <div class="flex items-center gap-2 mb-2">
      <span class="bg-neon text-ink text-[.65rem] font-syne font-bold px-2.5 py-1 rounded-full">AVAILABLE TODAY</span>
      <span class="bg-ink/70 text-white/70 text-[.65rem] px-2.5 py-1 rounded-full backdrop-blur-sm border border-neon/10">{{ $stadium->capacity / 2 }}-a-side · Grass</span>
    </div>
    <h1 class="font-bebas text-5xl tracking-wide text-white">{{ $stadium->name }}</h1>
    <p class="text-white/50 text-sm mt-1">📍 {{ $stadium->address }}</p>
  </div>
  <div class="absolute bottom-8 right-10 text-right">
    <div class="text-white/40 text-xs mb-1">Starting from</div>
    <div class="font-bebas text-4xl text-neon">{{ $stadium->price_per_hour }}<span class="text-2xl">MAD</span></div>
    <div class="text-white/35 text-xs">/hour</div>
  </div>
</div>

<!-- MAIN LAYOUT -->
<div class="flex gap-8 px-10 py-10 max-w-[1200px] mx-auto items-start">

  <!-- LEFT COLUMN -->
  <div class="flex-1 min-w-0">

    <!-- TABS -->
    <div class="flex gap-1 mb-8 bg-surface rounded-xl p-1 border border-neon/10 w-fit">
      <button onclick="showTab('book')" id="tab-book" class="tab-btn px-5 py-2 rounded-lg text-sm font-syne font-semibold text-white bg-card transition-all">Book</button>
      <button onclick="showTab('info')" id="tab-info" class="tab-btn px-5 py-2 rounded-lg text-sm font-syne font-semibold text-white/40 transition-all">Info</button>
    </div>

    <!-- INFO PANEL -->
    <div id="panel-info" class="hidden">
      <div class="font-syne font-bold text-sm text-white mb-4">Pitch Specifications</div>
      <div class="bg-card border border-neon/10 rounded-2xl divide-y divide-neon/10">
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Format</span><span class="text-sm text-white font-medium">{{ $stadium->capacity / 2 }}-a-side ({{ $stadium->capacity }} players max)</span></div>
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Surface</span><span class="text-sm text-white font-medium">Natural Grass</span></div>
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Dimensions</span><span class="text-sm text-white font-medium">40m × 20m</span></div>
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Address</span><span class="text-sm text-white font-medium">📍 {{ $stadium->address }}</span></div>
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Opening hours</span><span class="text-sm text-white font-medium">{{ $openingHours }}</span></div>
        <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Manager</span><span class="text-sm text-white font-medium">{{ $manager->fullname }}</span></div>
        <div class="flex justify-between px-5 py-3.5">
          <span class="text-sm text-white/40">Manager Phone</span>
          <span class="text-sm text-white font-medium">
            @if($manager->phone_number) {{ $manager->phone_number }} @else private @endif
          </span>
        </div>
      </div>
      <br>

      @if($stadium->note)
      <div class="font-syne font-bold text-sm text-white mb-4">Manager's Note</div>
      <div class="bg-neon/5 border border-neon/20 rounded-2xl p-5 relative overflow-hidden">
        {{-- Subtle background decoration --}}
        <div class="absolute top-[-10px] right-[-5px] text-4xl opacity-10 select-none"></div>

        <p class="text-sm text-white/80 leading-relaxed italic">
          "{{ $stadium->note }}"
        </p>
      </div>
      @endif
    </div>

    <!-- BOOK PANEL -->
    <div id="panel-book">
      <div class="mb-6">
        <div class="font-syne font-bold text-sm text-white mb-1">Select a Date</div>
        <input type="date"
          id="datePicker"
          value="{{ $date }}"
          min="{{ today()->toDateString() }}"
          class="bg-card border border-neon/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-neon/35 transition-all">
      </div>

      <div class="font-syne font-bold text-sm text-white mb-1">Available Time Slots</div>
      <p class="text-[.75rem] text-white/35 mb-5">Click a slot to select it. Green = available, Red = booked.</p>

      <div id="slotsGrid" class="grid grid-cols-4 gap-3"></div>

      {{-- Hidden values for JS --}}
      <input type="hidden" id="slotsRoute" value="{{ route('stadium.slots', $stadium->id) }}">
      <input type="hidden" id="storeRoute" value="{{ route('reservation.store', $stadium->id) }}">
      <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">
    </div>

  </div>

  <!-- RIGHT COLUMN -->
  <div class="w-72 bg-card border border-neon/10 rounded-2xl p-6 sticky top-24">
    <h2 class="font-syne font-bold text-white text-base mb-5">Reserve This Pitch</h2>

    <form method="POST" action="{{ route('reservation.store', $stadium->id) }}" id="bookingForm">
      @csrf
      <input type="hidden" name="date" id="selectedDate" value="{{ $date }}">
      <input type="hidden" name="start_time" id="selectedTime" value="">

      <p class="text-white/40 text-xs uppercase tracking-widest mb-1">Total</p>
      <p class="text-neon font-bebas text-3xl mb-4">{{ $stadium->price_per_hour }} <span class="text-xl">MAD / 1h</span></p>

      <p class="text-white/40 text-sm mb-4">
        Selected: <span id="selectedLabel" class="text-neon">None</span>
      </p>

      <button type="submit" class="w-full bg-neon text-ink font-syne font-bold py-3 rounded-xl hover:opacity-90 transition-all">
        Confirm Booking →
      </button>

      <p class="text-white/30 text-xs text-center mt-3">You'll receive a confirmation email instantly</p>
    </form>
  </div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('js/booking.js') }}" defer></script>

<script>
  function showTab(t) {
    ['book', 'info'].forEach(id => {
      document.getElementById('panel-' + id).classList.toggle('hidden', id !== t);
      const btn = document.getElementById('tab-' + id);
      btn.classList.toggle('bg-card', id === t);
      btn.classList.toggle('text-white', id === t);
      btn.classList.toggle('text-white/40', id !== t);
    });
  }
</script>
@endsection