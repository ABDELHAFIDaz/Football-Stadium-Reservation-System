@extends('layouts.app')

@section('title', "My Dashboard")

@include('layouts.navbar')

@section('content')

<!-- MAIN -->
<main class="flex-1 px-10 py-8 overflow-y-auto">

  <!-- just to keep the reservation id  for the modify form -->
  <div id="forReservationId">
    @php
    $reservationId = 0
    @endphp
  </div>

  <!-- HEADER -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <div class="text-[.7rem] font-semibold text-neon uppercase tracking-widest mb-1">Welcome back</div>
      <h1 class="font-bebas text-4xl tracking-wide text-white">{{ $user->fullname }}'S DASHBOARD</h1>
    </div>
    <a href="{{ route('pitches') }}" class="bg-neon text-ink font-syne font-bold text-sm tracking-wider px-6 py-3 rounded-xl hover:opacity-90 transition-all" style="box-shadow:0 0 24px rgba(61,255,122,.2)">+ Book a Pitch</a>
  </div>

  <!-- STATS -->
  <div class="grid grid-cols-4 gap-4 mb-8">
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Total Bookings (Confirmed, Ended)</div>
      <div class="font-bebas text-4xl text-white">{{ $reservationsCounter }}<span class="text-neon"></span></div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">This Month (Confirmed, Ended)</div>
      <div class="font-bebas text-4xl text-white">{{ $thisMonthReservations }}</div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Pending Ones</div>
      <div class="font-bebas text-4xl text-white">{{ $pendingReservationCounter }}<span class="text-neon"></span></div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Total Spent</div>
      @if($totalSpent >= 1000)
      <div class="font-bebas text-4xl text-white">{{ $totalSpent / 1000 }}<span class="text-neon">K</span></div>
      @else
      <div class="font-bebas text-4xl text-white">{{ $totalSpent }}</div>
      @endif
    </div>
  </div>

  <div class="grid grid-cols-3 gap-6">

    <!-- BOOKINGS -->
    <div class="col-span-2">
      <div class="flex items-center justify-between mb-4">
        <div class="font-syne font-bold text-sm text-white">Reservations</div>
      </div>
      <div class="flex flex-col gap-3">

        <!-- Filters -->
        <form method="GET" class="flex gap-3 mb-4">

          <!-- STATUS -->
          <select name="status" onchange="this.form.submit()"
            class="bg-card border border-neon/10 text-white text-xs rounded-lg px-3 py-2">
            <option value="all">All Status</option>
            <option value="confirmed" @selected(request('status')=='confirmed' )>✔Confirmed</option>
            <option value="pending" @selected(request('status')=='pending' )>⏳Pending</option>
            <option value="canceled" @selected(request('status')=='canceled' )>✖Canceled</option>
            <option value="ended" @selected(request('status')=='ended' )>🏁Ended</option>
          </select>

          <!-- SORT -->
          <select name="sort" onchange="this.form.submit()"
            class="bg-card border border-neon/10 text-white text-xs rounded-lg px-3 py-2">
            <option value="desc" @selected(request('sort')=='desc' || !request('sort'))>Newest</option>
            <option value="asc" @selected(request('sort')=='asc' )>Oldest</option>
          </select>

        </form>

        @foreach($reservations as $reservation)
        <div class="bg-card border border-neon/15 rounded-2xl p-5 mb-4">
          <div class="flex items-start justify-between gap-6">

            <div class="flex gap-4">
              <div class="w-12 h-12 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-xl">🏟️</div>
              <div>
                <div class="font-syne font-bold text-sm text-white">{{ $reservation->stadium->name }}</div>
                <div class="text-[.72rem] text-white/40 mt-0.5">📍 {{ $reservation->stadium->address }}</div>
                <div class="flex items-center gap-3 mt-2">
                  <span class="text-[.72rem] text-white/50">📅 {{ $reservation->reservation_date->format('M d, Y') }}</span>
                  <span class="text-[.72rem] text-white/50">⏰ {{ $reservation->start_time->format('H:i') }} – {{ $reservation->end_time->format('H:i') }}</span>
                  <span class="text-[.72rem] text-white/50">{{ $reservation->stadium->capacity }}-a-side</span>
                </div>
              </div>
            </div>

            <div class="flex items-start gap-4">

              @if(in_array($reservation->status, ['pending', 'confirmed']))
              <div class="flex flex-col gap-2">
                <button onclick="openModifyModal(
    '{{ route('reservation.update', $reservation->id) }}', 
    '{{ $reservation->stadium_id }}', 
    '{{ $reservation->reservation_date->format('Y-m-d') }}', 
    '{{ $reservation->start_time->format('H:i') }}', 
    '{{ $reservation->stadium->price_per_hour }}',
    '{{ $reservation->stadium->user->phone_number }}',
    '{{ $reservation->id }}'
)" class="min-w-[80px] text-[0.6rem] font-bold text-white/40 hover:text-white border border-neon/10 hover:border-neon/25 px-3 py-1.5 rounded-lg transition-all uppercase tracking-wider">
                  Modify
                </button>

                <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="w-full min-w-[80px] text-[0.6rem] font-bold text-red-400/70 hover:text-red-400 border border-red-500/10 hover:border-red-400/30 px-3 py-1.5 rounded-lg transition-all uppercase tracking-wider">
                    Cancel
                  </button>
                </form>
              </div>
              @endif

              <div class="flex flex-col items-end min-w-[100px]">
                <div class="px-2.5 py-1 rounded-full border mb-2 text-[.65rem] font-syne font-bold uppercase tracking-wider
          @switch($reservation->status)
              @case('confirmed') bg-neon/10 text-neon border-neon/20 @break
              @case('pending')   bg-yellow-500/10 text-yellow-500 border-yellow-500/20 @break
              @case('canceled')  bg-red-500/10 text-red-500 border-red-500/20 @break
              @case('ended')     bg-white/5 text-white/40 border-white/10 @break
              @default           bg-white/5 text-white border-white/10
          @endswitch">
                  @switch($reservation->status)
                  @case('confirmed')
                  <span>✔</span> <span>Confirmed</span>
                  @break

                  @case('pending')
                  <span>⏳</span> <span>Pending</span>
                  @break

                  @case('canceled')
                  <span>✖</span> <span>Canceled</span>
                  @break

                  @case('ended')
                  <span>🏁</span> <span>Ended</span>
                  @break

                  @default
                  <span>•</span> <span>{{ ucfirst($status) }}</span>
                  @endswitch
                </div>
                <div class="font-syne font-bold text-neon text-sm">{{ $reservation->total_price }} MAD</div>
              </div>

            </div>
          </div>
        </div>
        @endforeach

        @if(count($reservations) === 0)
        <h1 class="font-syne font-bold text-lg text-white">
          Nothing At The Moment!
        </h1>
        @endif

      </div>
    </div>



    <!-- RIGHT COLUMN -->
    <div class="flex flex-col gap-5">

      <!-- FAVORITES -->
      <div class="bg-card border border-neon/10 rounded-2xl p-5">
        <div class="font-syne font-bold text-sm text-white mb-4">Favorites</div>
        <div class="flex flex-col gap-3">
          @foreach($favoriteStadiums as $favorite)
          <a href="{{ route('stadium.book', $favorite->id) }}" class="flex items-center gap-3 hover:bg-surface rounded-xl px-2 py-1.5 transition-colors -mx-2">
            <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-lg flex items-center justify-center text-base">🏟️</div>
            <div class="flex-1 min-w-0">
              <div class="font-syne font-semibold text-xs text-white truncate">{{ $favorite->name }}</div>
              <div class="text-[.65rem] text-white/35">{{ ucfirst($favorite->city->name) }} · {{ $favorite->price_per_hour }} MAD/h</div>
            </div>
            <span class="text-neon text-xs">→</span>
          </a>
          @endforeach
        </div>
      </div>

      <!-- PROFILE CARD -->
      <div class="bg-card border border-neon/10 rounded-2xl p-5">
        <div class="font-syne font-bold text-sm text-white mb-4">Profile</div>
        <div class="flex flex-col gap-2.5 text-xs">
          <div class="flex justify-between"><span class="text-white/35">FullName</span><span class="text-white">{{ $user->fullname }}</span></div>
          <div class="flex justify-between"><span class="text-white/35">Email</span><span class="text-white/70">{{ $user->email }}</span></div>
          <div class="flex justify-between"><span class="text-white/35">Phone</span><span class="text-white/70">{{ $user->phone_number }}</span></div>
          <div class="flex justify-between"><span class="text-white/35">Member since</span><span class="text-white/70">{{ $user->created_at->format('M Y') }}</span></div>
        </div>
        <button onclick="openModal()"
          class="mt-4 w-full text-xs text-white/35 border border-neon/10 hover:border-neon/25 hover:text-white py-2 rounded-xl transition-all">
          Edit Profile
        </button>
      </div>
    </div>

    @if(count($reservations) !== 0)
    <p class="text-white/75 text-xs mb-1">⚠️ You can only modify reservations that are at least 3 hours ahead.</p>
    @endif

  </div>

  <div class="mt-8 pagination-neon">
    {{ $reservations->links() }}
  </div>
</main>

@include('layouts.editProfileModal')
@include('layouts.editReservationModal')

@include('layouts.footer')

@endsection


@section('scripts')
<script src="{{ asset('js/editReservation.js') }}" defer></script>

<script>
  function openModal() {
    document.getElementById('profileModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('profileModal').classList.add('hidden');
  }

  // Optional: Close if user clicks outside the modal box
  window.onclick = function(event) {
    let modal = document.getElementById('profileModal');
    if (event.target == modal) {
      closeModal();
    }
  }
</script>
@endsection