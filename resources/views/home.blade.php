@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<style>
  body {
    font-family: 'DM Sans', sans-serif;
    cursor: none;
  }

  .cursor {
    width: 10px;
    height: 10px;
    background: #3DFF7A;
    border-radius: 50%;
    position: fixed;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 9999;
    transform: translate(-50%, -50%);
    mix-blend-mode: difference;
  }

  .cursor-ring {
    width: 36px;
    height: 36px;
    border: 1.5px solid #3DFF7A;
    border-radius: 50%;
    position: fixed;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: 9998;
    transform: translate(-50%, -50%);
    transition: left .12s ease, top .12s ease, width .2s, height .2s;
    opacity: .5;
  }

  .field-grid {
    background-image: linear-gradient(rgba(61, 255, 122, .035) 1px, transparent 1px), linear-gradient(90deg, rgba(61, 255, 122, .035) 1px, transparent 1px);
    background-size: 80px 80px;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(20px)
    }

    to {
      opacity: 1;
      transform: translateY(0)
    }
  }

  @keyframes blink {

    0%,
    100% {
      opacity: 1
    }

    50% {
      opacity: .25
    }
  }

  .a1 {
    animation: slideUp .7s .00s ease both
  }

  .a2 {
    animation: slideUp .7s .10s ease both
  }

  .a3 {
    animation: slideUp .7s .18s ease both
  }

  .a4 {
    animation: slideUp .7s .26s ease both
  }

  .a5 {
    animation: slideUp .7s .38s ease both
  }

  .blink {
    animation: blink 2s infinite
  }

  .glow {
    box-shadow: 0 0 40px rgba(61, 255, 122, .22)
  }

  .glow:hover {
    box-shadow: 0 8px 48px rgba(61, 255, 122, .32)
  }

  .top-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #3DFF7A, transparent);
    opacity: 0;
    transition: opacity .3s
  }

  .feat:hover .top-line {
    opacity: 1
  }
</style>
@endsection

@section('content')
<!-- HERO -->
<section class="relative min-h-screen flex flex-col justify-center px-14 pt-32 pb-20 overflow-hidden">
  <div class="absolute inset-0 field-grid pointer-events-none"></div>
  <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 60% 50% at 76% 55%,rgba(61,255,122,.08) 0%,transparent 60%),radial-gradient(ellipse 40% 60% at 14% 40%,rgba(61,255,122,.04) 0%,transparent 50%)"></div>

  <div class="a1 inline-flex items-center gap-2 bg-card border border-neon/10 rounded-full px-4 py-1.5 text-[.72rem] font-medium text-neon tracking-[.13em] uppercase w-fit mb-8">
    <span class="blink w-1.5 h-1.5 rounded-full bg-neon inline-block"></span>
    Smart Football Reservations
  </div>

  <h1 class="a2 font-bebas leading-[.92] tracking-wide text-white mb-3" style="font-size:clamp(5rem,12vw,10rem)">
    BOOK YOUR<br><span class="text-neon">FIELD.</span><br>PLAY MORE.
  </h1>
  <p class="a3 font-syne font-semibold text-white/40 tracking-wider mb-6" style="font-size:clamp(1rem,2.2vw,1.35rem)">No conflicts. No waiting. Just football.</p>
  <p class="a3 max-w-[460px] text-sm leading-7 text-white/35 mb-12">BALLe is the smarter way to reserve football pitches — instant booking, real-time availability, and automatic confirmations.</p>

  <div class="a4 flex gap-4 flex-wrap">
    <a href="{{ route('pitches') }}" class="glow bg-neon text-ink font-syne font-bold text-sm tracking-wider px-9 py-4 rounded-xl hover:-translate-y-0.5 transition-all">Reserve a Pitch</a>
    @guest
    <a href="{{ route('login.page') }}" class="border border-neon/10 text-white font-syne font-semibold text-sm tracking-wider px-9 py-4 rounded-xl hover:border-neon/30 hover:bg-card transition-all">Sign In</a>
    @endguest
  </div>

  <!-- SEARCH CARD -->
  <div class="a5 absolute right-14 top-1/2 -translate-y-1/2 w-[330px] bg-card border border-neon/10 rounded-2xl p-7">
    <div class="font-syne font-bold text-[.73rem] tracking-[.12em] uppercase text-neon mb-5">⚽ Find a Pitch</div>
    <div class="flex flex-col gap-2.5 mb-3">
      <input class="bg-surface border border-neon/10 rounded-lg px-4 py-3 text-white text-[.85rem] outline-none placeholder-white/25 focus:border-neon/35 transition-colors font-dm w-full" type="text" placeholder="🏙️ City (e.g. Casablanca)">
      <input class="bg-surface border border-neon/10 rounded-lg px-4 py-3 text-white/35 text-[.85rem] outline-none focus:border-neon/35 transition-colors font-dm w-full" type="date">
      <select class="bg-surface border border-neon/10 rounded-lg px-4 py-3 text-white/35 text-[.85rem] outline-none focus:border-neon/35 transition-colors font-dm w-full">
        <option value="" disabled selected>👥 Capacity</option>
        <option>5-a-side (10 players)</option>
        <option>7-a-side (14 players)</option>
        <option>11-a-side (22 players)</option>
      </select>
    </div>
    <button class="w-full bg-neon text-ink font-syne font-bold text-[.85rem] tracking-wider py-3 rounded-lg hover:opacity-88 transition-opacity">Search Available Pitches</button>
    <p class="text-[.69rem] text-white/30 text-center mt-3"><span class="text-neon font-semibold">24 pitches</span> available right now</p>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="px-14 py-24 bg-surface border-t border-b border-neon/10" id="how">
  <div class="text-[.72rem] font-semibold text-neon uppercase tracking-[.14em] mb-4">Process</div>
  <h2 class="font-bebas leading-none tracking-wide text-white" style="font-size:clamp(2.8rem,5vw,4.4rem)">HOW IT WORKS</h2>
  <div class="grid grid-cols-4 gap-10 mt-14">
    <div class="relative">
      <div class="font-bebas text-[4rem] leading-none text-neon/10 mb-4 tracking-widest">01</div>
      <div class="font-syne font-bold text-sm text-white mb-2">Create your account</div>
      <div class="text-[.82rem] text-white/35 leading-7">Sign up in under a minute. Choose your role as a player or stadium manager.</div>
      <div class="absolute top-7 -right-5 w-10 h-px bg-neon/10"></div>
    </div>
    <div class="relative">
      <div class="font-bebas text-[4rem] leading-none text-neon/10 mb-4 tracking-widest">02</div>
      <div class="font-syne font-bold text-sm text-white mb-2">Search pitches</div>
      <div class="text-[.82rem] text-white/35 leading-7">Filter by city, date, time and capacity to find pitches that match your game.</div>
      <div class="absolute top-7 -right-5 w-10 h-px bg-neon/10"></div>
    </div>
    <div class="relative">
      <div class="font-bebas text-[4rem] leading-none text-neon/10 mb-4 tracking-widest">03</div>
      <div class="font-syne font-bold text-sm text-white mb-2">Book your slot</div>
      <div class="text-[.82rem] text-white/35 leading-7">Pick your timeslot and confirm your reservation instantly — no waiting.</div>
      <div class="absolute top-7 -right-5 w-10 h-px bg-neon/10"></div>
    </div>
    <div>
      <div class="font-bebas text-[4rem] leading-none text-neon/10 mb-4 tracking-widest">04</div>
      <div class="font-syne font-bold text-sm text-white mb-2">Get confirmation</div>
      <div class="text-[.82rem] text-white/35 leading-7">Receive an automatic email confirmation and show up ready to play.</div>
    </div>
  </div>
</section>

<!-- CTA -->
@guest
<section class="relative px-14 py-32 text-center overflow-hidden">
  <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 60% 70% at 50% 50%,rgba(61,255,122,.06) 0%,transparent 60%)"></div>
  <div class="text-[.72rem] font-semibold text-neon uppercase tracking-[.14em] mb-4">Get started today</div>
  <h2 class="font-bebas leading-none tracking-wide text-white mb-5" style="font-size:clamp(2.8rem,5vw,4.4rem)">READY TO<br><span class="text-neon">HIT THE PITCH?</span></h2>
  <p class="max-w-[420px] mx-auto text-sm leading-7 text-white/35 mb-12">Join hundreds of players already booking smarter with BALLe.</p>
  <div class="flex gap-4 justify-center">
    <a href="{{ route('signup') }}" class="glow bg-neon text-ink font-syne font-bold text-sm tracking-wider px-9 py-4 rounded-xl hover:-translate-y-0.5 transition-all">Create Free Account</a>
    <a href="{{ route('login.page') }}" class="border border-neon/10 text-white font-syne font-semibold text-sm tracking-wider px-9 py-4 rounded-xl hover:border-neon/30 hover:bg-card transition-all">Sign In</a>
  </div>
</section>
@endguest

<!-- FOOTER -->
<footer class="px-14 py-10 border-t border-neon/10 flex items-center justify-between">
  <div class="font-bebas text-2xl tracking-[3px] text-neon">B<span class="text-white/35">ALL</span>e</div>
  <div class="flex gap-6">
    <a href="#" class="text-xs text-white/30 hover:text-white/60 transition-colors">Features</a>
    <a href="#" class="text-xs text-white/30 hover:text-white/60 transition-colors">Privacy</a>
    <a href="#" class="text-xs text-white/30 hover:text-white/60 transition-colors">Contact</a>
  </div>
  <div class="text-xs text-white/25">© 2025 BALLe. Smart Football Reservations.</div>
</footer>

@endsection

@section('scripts')

<script>
  const cursor = document.getElementById('cursor'),
    ring = document.getElementById('cursorRing');
  document.addEventListener('mousemove', e => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
    ring.style.left = e.clientX + 'px';
    ring.style.top = e.clientY + 'px';
  });
  document.querySelectorAll('a,button,input,select').forEach(el => {
    el.addEventListener('mouseenter', () => {
      ring.style.width = '56px';
      ring.style.height = '56px';
      ring.style.opacity = '0.8';
    });
    el.addEventListener('mouseleave', () => {
      ring.style.width = '36px';
      ring.style.height = '36px';
      ring.style.opacity = '0.5';
    });
  });
</script>

@endsection