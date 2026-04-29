<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BALLe – $stadium->name </title>
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
      background-image: linear-gradient(rgba(61, 255, 122, .04) 1px, transparent 1px), linear-gradient(90deg, rgba(61, 255, 122, .04) 1px, transparent 1px);
      background-size: 50px 50px;
    }

    .slot {
      cursor: pointer;
      transition: all .15s;
    }

    .slot.free {
      background: rgba(61, 255, 122, .08);
      border-color: rgba(61, 255, 122, .2);
    }

    .slot.free:hover {
      background: rgba(61, 255, 122, .18);
      border-color: #3DFF7A;
    }

    .slot.busy {
      background: rgba(255, 87, 87, .07);
      border-color: rgba(255, 87, 87, .2);
      cursor: not-allowed;
      opacity: .6;
    }

    .slot.selected {
      background: rgba(61, 255, 122, .2);
      border-color: #3DFF7A;
      box-shadow: 0 0 12px rgba(61, 255, 122, .15);
    }

    .glow {
      box-shadow: 0 0 32px rgba(61, 255, 122, .2)
    }

    .glow:hover {
      box-shadow: 0 6px 40px rgba(61, 255, 122, .3)
    }
  </style>
</head>

<body class="bg-ink text-white">

  <!-- NAV -->
  <nav class="sticky top-0 z-50 flex items-center justify-between px-10 h-[64px] bg-ink/90 backdrop-blur-2xl border-b border-neon/10">
    <a href="home.html" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>
    <div class="flex items-center gap-2 text-sm text-white/40">
      <a href="pitches.html" class="hover:text-white transition-colors">Pitches</a>
      <span>/</span>
      <span class="text-white">{{$stadium->name}}</span>
    </div>
    <div class="flex items-center gap-2">
      <a href="login.html" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Sign in</a>
      <a href="signup.html" class="bg-neon text-ink font-syne font-bold text-xs tracking-widest px-4 py-2.5 rounded-lg hover:opacity-90 transition-all">Get Started</a>
    </div>
  </nav>

  <!-- HERO IMAGE -->
  <div
    class="relative h-72 overflow-hidden"
    style="background:linear-gradient(135deg,#0a2015 0%,#061410 100%)">
    <div class="absolute inset-0 field-grid"></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <div class="text-[10rem] opacity-10">🏟️</div>
    </div>
    <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(6,10,7,1) 0%,transparent 50%)"></div>
    <div class="absolute bottom-8 left-10 flex items-end gap-5">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <span class="bg-neon text-ink text-[.65rem] font-syne font-bold px-2.5 py-1 rounded-full">AVAILABLE TODAY</span>
          <span class="bg-ink/70 text-white/70 text-[.65rem] px-2.5 py-1 rounded-full backdrop-blur-sm border border-neon/10">{{$stadium->capacity / 2}}-a-side · Grass</span>
        </div>
        <h1 class="font-bebas text-5xl tracking-wide text-white">{{$stadium->name}}</h1>
        <p class="text-white/50 text-sm mt-1">📍 {{$stadium->address}}</p>
      </div>
    </div>
    <div class="absolute bottom-8 right-10 text-right">
      <div class="text-white/40 text-xs mb-1">Starting from</div>
      <div class="font-bebas text-4xl text-neon">{{$stadium->price_per_hour }}<span class="text-2xl">MAD</span></div>
      <div class="text-white/35 text-xs">/hour</div>
    </div>
  </div>

  <!-- MAIN LAYOUT: left column + right sidebar -->
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
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Format</span><span class="text-sm text-white font-medium">{{$stadium->capacity / 2}}-a-side ({{$stadium->capacity}} players max)</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Surface</span><span class="text-sm text-white font-medium">Natural Grass</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Dimensions</span><span class="text-sm text-white font-medium">40m × 20m</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Address</span><span class="text-sm text-white font-medium">📍 {{ $stadium->address }}</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Opening hours</span><span class="text-sm text-white font-medium">{{ $openingHours }}</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Manager</span><span class="text-sm text-white font-medium">{{ $manager->fullname }}</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Manager Phone Number</span><span class="text-sm text-white font-medium">
              @if($manager->phone_number)
              {{ $manager->phone_number }}
              @else
              private
              @endif
            </span></div>
        </div>
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
        <div class="mb-2">


          <div class="font-syne font-bold text-sm text-white mb-1">Available Time Slots</div>
          <p class="text-[.75rem] text-white/35 mb-5">Click a slot to select it. Green = available, Red = booked.</p>
        </div>

        {{-- Slots will be injected here --}}
        <div id="slotsGrid" class="grid grid-cols-4 gap-3"></div>

        {{-- Hidden values we need in JS --}}
        <input type="hidden" id="stadiumId" value="{{ $stadium->id }}">
        <input type="hidden" id="slotsRoute" value="{{ route('stadiums.slots', $stadium->id) }}">
        <input type="hidden" id="storeRoute" value="{{ route('reservations.store', $stadium->id) }}">
        <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">



      </div>

    </div>

    <!-- RIGHT COLUMN — Booking Card -->


    <!-- Right side card -->
    <div class="reserve-card">
      <h2>Reserve This Pitch</h2>

      <form method="POST" action="{{ route('reservations.store', $stadium->id) }}" id="bookingForm">
        @csrf
        <input type="hidden" name="date" id="selectedDate" value="{{ $date }}">
        <input type="hidden" name="start_time" id="selectedTime" value="">

        <!-- Total price -->
        <p class="text-white/40 text-sm">Total</p>
        <p class="text-green-400 font-bold text-xl">{{ $stadium->price_per_hour }} MAD / 1h</p>

        <!-- Shows which slot is selected -->
        <p class="text-white/40 text-sm mt-3">
          Selected: <span id="selectedLabel" class="text-green-400">None</span>
        </p>

        <!-- Submit -->
        <button type="submit" class="w-full bg-green-400 text-black font-bold py-3 rounded-xl hover:bg-green-300 transition-all mt-4">
          Confirm Booking →
        </button>

        <p class="text-white/30 text-xs text-center mt-2">You'll receive a confirmation email instantly</p>
      </form>
    </div>

  </div><!-- end main flex container -->

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
    let sel = null;

    function selectSlot(el) {
      if (el.classList.contains('busy')) return;
      if (sel && sel !== el) sel.classList.remove('selected');
      el.classList.toggle('selected');
      sel = el.classList.contains('selected') ? el : null;
    }

    const datePicker = document.getElementById('datePicker');
    const slotsGrid = document.getElementById('slotsGrid');
    const slotsRoute = document.getElementById('slotsRoute').value;
    const storeRoute = document.getElementById('storeRoute').value;
    const csrfToken = document.getElementById('csrfToken').value;

    // Fetch slots from the server and render them
    function loadSlots(date) {
      fetch(`${slotsRoute}?date=${date}`)
        .then(res => res.json())
        .then(slots => {
          slotsGrid.innerHTML = '';

          slots.forEach(slot => {
            if (slot.booked) {
              slotsGrid.innerHTML += `
            <div class="flex flex-col items-center justify-center rounded-xl py-5 bg-red-950 border border-red-900 cursor-not-allowed">
                <span class="text-white/40 font-semibold text-base">${slot.time}</span>
                <span class="text-red-500 text-xs mt-1">Booked</span>
            </div>`;
            } else {
              slotsGrid.innerHTML += `
            <div onclick="selectSlot('${slot.time}')"
                 id="slot-${slot.time.replace(':', '-')}"
                 class="slot-card flex flex-col items-center justify-center rounded-xl py-5 bg-green-950 border border-green-800 hover:border-green-400 hover:bg-green-900 transition-all cursor-pointer">
                <span class="text-white font-semibold text-base">${slot.time}</span>
                <span class="text-white/50 text-xs mt-1">1h</span>
            </div>`;
            }
          });
        });
    }

    function selectSlot(time) {
      // Remove highlight from all slots
      document.querySelectorAll('.slot-card').forEach(el => {
        el.classList.remove('border-green-400', 'bg-green-900');
        el.classList.add('border-green-800', 'bg-green-950');
      });

      // Highlight the clicked one
      const selected = document.getElementById('slot-' + time.replace(':', '-'));
      selected.classList.add('border-green-400', 'bg-green-900');

      // Update the hidden inputs and label
      document.getElementById('selectedTime').value = time;
      document.getElementById('selectedDate').value = document.getElementById('datePicker').value;
      document.getElementById('selectedLabel').textContent = time;
    }

    // Load slots when date changes
    datePicker.addEventListener('change', function() {
      loadSlots(this.value);
    });

    // Load slots on page load with the default date
    loadSlots(datePicker.value);
  </script>
</body>

</html>