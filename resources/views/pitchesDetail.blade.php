<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BALLe – Stade Al Fath</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<script>tailwind.config={theme:{extend:{colors:{neon:'#3DFF7A',ink:'#060A07',surface:'#0C1210',card:'#131A15'},fontFamily:{bebas:['Bebas Neue','sans-serif'],syne:['Syne','sans-serif'],dm:['DM Sans','sans-serif']}}}}</script>
<style>
body{font-family:'DM Sans',sans-serif;}
.field-grid{background-image:linear-gradient(rgba(61,255,122,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(61,255,122,.04) 1px,transparent 1px);background-size:50px 50px;}
.slot{cursor:pointer;transition:all .15s;}
.slot.free{background:rgba(61,255,122,.08);border-color:rgba(61,255,122,.2);}
.slot.free:hover{background:rgba(61,255,122,.18);border-color:#3DFF7A;}
.slot.busy{background:rgba(255,87,87,.07);border-color:rgba(255,87,87,.2);cursor:not-allowed;opacity:.6;}
.slot.selected{background:rgba(61,255,122,.2);border-color:#3DFF7A;box-shadow:0 0 12px rgba(61,255,122,.15);}
.glow{box-shadow:0 0 32px rgba(61,255,122,.2)}.glow:hover{box-shadow:0 6px 40px rgba(61,255,122,.3)}
</style>
</head>
<body class="bg-ink text-white">

<!-- NAV -->
<nav class="sticky top-0 z-50 flex items-center justify-between px-10 h-[64px] bg-ink/90 backdrop-blur-2xl border-b border-neon/10">
  <a href="home.html" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>
  <div class="flex items-center gap-2 text-sm text-white/40">
    <a href="pitches.html" class="hover:text-white transition-colors">Pitches</a>
    <span>/</span>
    <span class="text-white">Stade Al Fath</span>
  </div>
  <div class="flex items-center gap-2">
    <a href="login.html" class="text-white/40 text-xs px-4 py-2 rounded-lg hover:text-white hover:bg-card transition-all">Sign in</a>
    <a href="signup.html" class="bg-neon text-ink font-syne font-bold text-xs tracking-widest px-4 py-2.5 rounded-lg hover:opacity-90 transition-all">Get Started</a>
  </div>
</nav>

<!-- HERO IMAGE -->
<div class="relative h-72 overflow-hidden" style="background:linear-gradient(135deg,#0a2015 0%,#061410 100%)">
  <div class="absolute inset-0 field-grid"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <div class="text-[10rem] opacity-10">🏟️</div>
  </div>
  <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(6,10,7,1) 0%,transparent 50%)"></div>
  <div class="absolute bottom-8 left-10 flex items-end gap-5">
    <div>
      <div class="flex items-center gap-2 mb-2">
        <span class="bg-neon text-ink text-[.65rem] font-syne font-bold px-2.5 py-1 rounded-full">AVAILABLE TODAY</span>
        <span class="bg-ink/70 text-white/70 text-[.65rem] px-2.5 py-1 rounded-full backdrop-blur-sm border border-neon/10">5-a-side · Grass</span>
      </div>
      <h1 class="font-bebas text-5xl tracking-wide text-white">Stade Al Fath</h1>
      <p class="text-white/50 text-sm mt-1">📍 Casablanca, Maarif · Rue Ibn Sina</p>
    </div>
  </div>
  <div class="absolute bottom-8 right-10 text-right">
    <div class="text-white/40 text-xs mb-1">Starting from</div>
    <div class="font-bebas text-4xl text-neon">150 <span class="text-2xl">MAD</span></div>
    <div class="text-white/35 text-xs">/hour</div>
  </div>
</div>

<div class="flex gap-8 px-10 py-10 max-w-[1200px] mx-auto">

  <!-- LEFT COLUMN -->
  <div class="flex-1 min-w-0">

    <!-- TABS -->
    <div class="flex gap-1 mb-8 bg-surface rounded-xl p-1 border border-neon/10 w-fit">
      <button onclick="showTab('info')" id="tab-info" class="tab-btn px-5 py-2 rounded-lg text-sm font-syne font-semibold text-white bg-card transition-all">Info</button>
      <button onclick="showTab('book')" id="tab-book" class="tab-btn px-5 py-2 rounded-lg text-sm font-syne font-semibold text-white/40 transition-all">Book</button>
      <button onclick="showTab('reviews')" id="tab-reviews" class="tab-btn px-5 py-2 rounded-lg text-sm font-syne font-semibold text-white/40 transition-all">Reviews</button>
    </div>

    <!-- INFO TAB -->
    <div id="panel-info">
      <!-- AMENITIES -->
      <div class="mb-8">
        <div class="font-syne font-bold text-sm text-white mb-4">Amenities & Features</div>
        <div class="grid grid-cols-3 gap-3">
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">💡</span><span class="text-sm text-white/60">Floodlights</span></div>
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">🚿</span><span class="text-sm text-white/60">Showers</span></div>
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">🅿️</span><span class="text-sm text-white/60">Free Parking</span></div>
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">👟</span><span class="text-sm text-white/60">Shoe Rental</span></div>
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">⚽</span><span class="text-sm text-white/60">Ball Provided</span></div>
          <div class="bg-card border border-neon/10 rounded-xl px-4 py-3 flex items-center gap-3"><span class="text-lg">🥤</span><span class="text-sm text-white/60">Snack Bar</span></div>
        </div>
      </div>

      <!-- PITCH SPECS -->
      <div class="mb-8">
        <div class="font-syne font-bold text-sm text-white mb-4">Pitch Specifications</div>
        <div class="bg-card border border-neon/10 rounded-2xl divide-y divide-neon/10">
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Format</span><span class="text-sm text-white font-medium">5-a-side (10 players max)</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Surface</span><span class="text-sm text-white font-medium">Natural Grass</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Dimensions</span><span class="text-sm text-white font-medium">40m × 20m</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Lighting</span><span class="text-sm text-white font-medium">LED Floodlights (all hours)</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Opening hours</span><span class="text-sm text-white font-medium">07:00 – 23:00</span></div>
          <div class="flex justify-between px-5 py-3.5"><span class="text-sm text-white/40">Manager</span><span class="text-sm text-white font-medium">Hassan Berrada</span></div>
        </div>
      </div>

      <!-- LOCATION -->
      <div>
        <div class="font-syne font-bold text-sm text-white mb-4">Location</div>
        <div class="bg-card border border-neon/10 rounded-2xl h-40 flex items-center justify-center relative overflow-hidden">
          <div class="absolute inset-0 field-grid opacity-40"></div>
          <div class="relative z-10 text-center">
            <div class="text-3xl mb-2">🗺️</div>
            <div class="text-sm text-white/40">Rue Ibn Sina, Maarif, Casablanca</div>
            <a href="#" class="text-neon text-xs font-semibold hover:opacity-75 transition-opacity mt-1 block">Open in Google Maps →</a>
          </div>
        </div>
      </div>
    </div>

    <!-- BOOK TAB -->
    <div id="panel-book" class="hidden">
      <div class="mb-6">
        <div class="font-syne font-bold text-sm text-white mb-1">Select a Date</div>
        <input type="date" class="bg-card border border-neon/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-neon/35 transition-all">
      </div>
      <div class="mb-2">
        <div class="font-syne font-bold text-sm text-white mb-1">Available Time Slots</div>
        <p class="text-[.75rem] text-white/35 mb-5">Click a slot to select it. Green = available, Red = booked.</p>
      </div>
      <div class="grid grid-cols-4 gap-2.5">
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">07:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">08:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot busy border rounded-xl px-3 py-3 text-center"><div class="text-xs font-syne font-bold text-white/40">09:00</div><div class="text-[.65rem] text-red-400/70 mt-0.5">Booked</div></div>
        <div class="slot busy border rounded-xl px-3 py-3 text-center"><div class="text-xs font-syne font-bold text-white/40">10:00</div><div class="text-[.65rem] text-red-400/70 mt-0.5">Booked</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">11:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">12:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">13:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot busy border rounded-xl px-3 py-3 text-center"><div class="text-xs font-syne font-bold text-white/40">14:00</div><div class="text-[.65rem] text-red-400/70 mt-0.5">Booked</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">15:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">16:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">17:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">18:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot busy border rounded-xl px-3 py-3 text-center"><div class="text-xs font-syne font-bold text-white/40">19:00</div><div class="text-[.65rem] text-red-400/70 mt-0.5">Booked</div></div>
        <div class="slot busy border rounded-xl px-3 py-3 text-center"><div class="text-xs font-syne font-bold text-white/40">20:00</div><div class="text-[.65rem] text-red-400/70 mt-0.5">Booked</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">21:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
        <div class="slot free border rounded-xl px-3 py-3 text-center" onclick="selectSlot(this)"><div class="text-xs font-syne font-bold text-white">22:00</div><div class="text-[.65rem] text-white/40 mt-0.5">1h</div></div>
      </div>
    </div>

    <!-- REVIEWS TAB -->
    <div id="panel-reviews" class="hidden">
      <div class="flex items-center gap-8 mb-8 bg-card border border-neon/10 rounded-2xl p-6">
        <div class="text-center"><div class="font-bebas text-6xl text-neon leading-none">4.8</div><div class="text-yellow-400 text-sm mt-1">★★★★★</div><div class="text-xs text-white/35 mt-1">24 reviews</div></div>
        <div class="flex-1">
          <div class="flex items-center gap-3 mb-2"><span class="text-xs text-white/40 w-4">5</span><div class="flex-1 h-1.5 bg-surface rounded-full overflow-hidden"><div class="h-full bg-neon rounded-full" style="width:75%"></div></div><span class="text-xs text-white/35">75%</span></div>
          <div class="flex items-center gap-3 mb-2"><span class="text-xs text-white/40 w-4">4</span><div class="flex-1 h-1.5 bg-surface rounded-full overflow-hidden"><div class="h-full bg-neon/60 rounded-full" style="width:18%"></div></div><span class="text-xs text-white/35">18%</span></div>
          <div class="flex items-center gap-3 mb-2"><span class="text-xs text-white/40 w-4">3</span><div class="flex-1 h-1.5 bg-surface rounded-full overflow-hidden"><div class="h-full bg-neon/30 rounded-full" style="width:5%"></div></div><span class="text-xs text-white/35">5%</span></div>
          <div class="flex items-center gap-3 mb-2"><span class="text-xs text-white/40 w-4">2</span><div class="flex-1 h-1.5 bg-surface rounded-full overflow-hidden"><div class="h-full bg-neon/15 rounded-full" style="width:2%"></div></div><span class="text-xs text-white/35">2%</span></div>
          <div class="flex items-center gap-3"><span class="text-xs text-white/40 w-4">1</span><div class="flex-1 h-1.5 bg-surface rounded-full overflow-hidden"><div class="h-full bg-neon/10 rounded-full" style="width:0%"></div></div><span class="text-xs text-white/35">0%</span></div>
        </div>
      </div>
      <div class="flex flex-col gap-4">
        <div class="bg-card border border-neon/10 rounded-2xl p-5">
          <div class="flex items-center justify-between mb-3"><div class="flex items-center gap-3"><div class="w-8 h-8 bg-neon/10 border border-neon/20 rounded-full flex items-center justify-center text-xs font-bold text-neon">AM</div><div><div class="font-syne font-bold text-xs text-white">Ahmed Moussaoui</div><div class="text-[.68rem] text-white/30">March 2025</div></div></div><div class="text-yellow-400 text-xs">★★★★★</div></div>
          <p class="text-sm text-white/55 leading-7">Great pitch, well maintained grass and excellent lighting for evening games. Booking was seamless through the app. Will definitely come back!</p>
        </div>
        <div class="bg-card border border-neon/10 rounded-2xl p-5">
          <div class="flex items-center justify-between mb-3"><div class="flex items-center gap-3"><div class="w-8 h-8 bg-neon/10 border border-neon/20 rounded-full flex items-center justify-center text-xs font-bold text-neon">SB</div><div><div class="font-syne font-bold text-xs text-white">Sara Benali</div><div class="text-[.68rem] text-white/30">February 2025</div></div></div><div class="text-yellow-400 text-xs">★★★★☆</div></div>
          <p class="text-sm text-white/55 leading-7">Good facilities overall. Showers could use some renovation but the pitch itself is top notch. Location is convenient with easy parking access.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT: BOOKING CARD -->
  <div class="w-[300px] flex-shrink-0">
    <div class="bg-card border border-neon/10 rounded-2xl p-6 sticky top-[80px]">
      <div class="font-syne font-bold text-sm text-white mb-5">Reserve This Pitch</div>

      <div class="flex flex-col gap-3 mb-5">
        <div><label class="block text-[.68rem] font-semibold text-white/40 uppercase tracking-widest mb-1.5">Date</label><input type="date" class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white/70 text-sm outline-none focus:border-neon/35 transition-all"></div>
        <div><label class="block text-[.68rem] font-semibold text-white/40 uppercase tracking-widest mb-1.5">Time Slot</label><select class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white/70 text-sm outline-none focus:border-neon/35 transition-all"><option disabled selected>Select a slot</option><option>07:00 – 08:00</option><option>08:00 – 09:00</option><option>11:00 – 12:00</option><option>15:00 – 16:00</option></select></div>
        <div><label class="block text-[.68rem] font-semibold text-white/40 uppercase tracking-widest mb-1.5">Duration</label><select class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white/70 text-sm outline-none focus:border-neon/35 transition-all"><option>1 hour</option><option>1.5 hours</option><option>2 hours</option></select></div>
      </div>

      <div class="border-t border-neon/10 pt-4 mb-5">
        <div class="flex justify-between text-sm mb-2"><span class="text-white/40">1 hour × 150 MAD</span><span class="text-white">150 MAD</span></div>
        <div class="flex justify-between text-sm mb-3"><span class="text-white/40">Service fee</span><span class="text-white">15 MAD</span></div>
        <div class="flex justify-between font-syne font-bold"><span class="text-white">Total</span><span class="text-neon text-lg">165 MAD</span></div>
      </div>

      <a href="dashboard-user.html" class="block w-full text-center bg-neon text-ink font-syne font-bold text-sm tracking-wider py-3.5 rounded-xl hover:opacity-90 hover:-translate-y-px transition-all" style="box-shadow:0 0 24px rgba(61,255,122,.2)">Confirm Booking →</a>
      <p class="text-[.68rem] text-white/25 text-center mt-3">You'll receive a confirmation email instantly</p>
    </div>
  </div>
</div>

<script>
function showTab(t){
  ['info','book','reviews'].forEach(id=>{
    document.getElementById('panel-'+id).classList.toggle('hidden',id!==t);
    const btn=document.getElementById('tab-'+id);
    btn.classList.toggle('bg-card',id===t);btn.classList.toggle('text-white',id===t);
    btn.classList.toggle('text-white/40',id!==t);
  });
}
let sel=null;
function selectSlot(el){
  if(el.classList.contains('busy'))return;
  if(sel&&sel!==el)sel.classList.remove('selected');
  el.classList.toggle('selected');
  sel=el.classList.contains('selected')?el:null;
}
</script>
</body>
</html>