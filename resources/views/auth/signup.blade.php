<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BALLe – Create Account</title>
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
            card: '#131A15',
          },
          fontFamily: {
            bebas: ['Bebas Neue', 'sans-serif'],
            syne: ['Syne', 'sans-serif'],
            dm: ['DM Sans', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <style>
    body {
      font-family: 'DM Sans', sans-serif;
    }

    .field-grid {
      background-image: linear-gradient(rgba(61, 255, 122, .035) 1px, transparent 1px), linear-gradient(90deg, rgba(61, 255, 122, .035) 1px, transparent 1px);
      background-size: 60px 60px;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(16px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    .anim {
      animation: slideUp .55s ease both;
    }

    .glow {
      box-shadow: 0 0 32px rgba(61, 255, 122, .2);
    }

    .glow:hover {
      box-shadow: 0 6px 40px rgba(61, 255, 122, .3);
    }

    input[type=radio]:checked+label {
      border-color: #3DFF7A !important;
      background: rgba(61, 255, 122, .06) !important;
    }
  </style>
</head>

<body class="bg-ink text-white min-h-screen grid grid-cols-2">

  <!-- LEFT: FORM PANEL -->
  <div class="flex flex-col justify-center items-center px-16 py-12 overflow-y-auto">
    <div class="w-full max-w-[420px] anim">

      <a href="home.html" class="inline-flex items-center gap-2 text-[.79rem] text-white/30 hover:text-white/60 transition-colors mb-10">
        ← Back to home
      </a>

      <!-- HEADER -->
      <div class="mb-7">
        <div class="text-[.71rem] font-semibold text-neon uppercase tracking-[.14em] mb-2.5">Create Account</div>
        <h2 class="font-syne font-extrabold text-[1.8rem] text-white leading-tight">Join BALLe today</h2>
        <p class="text-[.84rem] text-white/40 mt-2">Pick your role and get started in seconds.</p>
      </div>

      <!-- ROLE SELECTOR -->
      <div class="grid grid-cols-3 gap-2 mb-6">
        <div>
          <input type="radio" name="role" id="r-player" value="player" class="sr-only" checked>
          <label for="r-player" class="flex flex-col items-center gap-1.5 px-3 py-3.5 bg-surface border-[1.5px] border-neon/10 rounded-xl cursor-pointer hover:border-neon/25 transition-all text-center">
            <span class="text-2xl">🏃</span>
            <span class="font-syne font-bold text-[.7rem] text-white tracking-wide">Player</span>
            <span class="text-[.62rem] text-white/30 leading-tight">Book pitches</span>
          </label>
        </div>
        <div>
          <input type="radio" name="role" id="r-manager" value="manager" class="sr-only">
          <label for="r-manager" class="flex flex-col items-center gap-1.5 px-3 py-3.5 bg-surface border-[1.5px] border-neon/10 rounded-xl cursor-pointer hover:border-neon/25 transition-all text-center">
            <span class="text-2xl">🏟️</span>
            <span class="font-syne font-bold text-[.7rem] text-white tracking-wide">Manager</span>
            <span class="text-[.62rem] text-white/30 leading-tight">Manage stadiums</span>
          </label>
        </div>
        <!-- <div>
        <input type="radio" name="role" id="r-admin" value="admin" class="sr-only">
        <label for="r-admin" class="flex flex-col items-center gap-1.5 px-3 py-3.5 bg-surface border-[1.5px] border-neon/10 rounded-xl cursor-pointer hover:border-neon/25 transition-all text-center">
          <span class="text-2xl">⚙️</span>
          <span class="font-syne font-bold text-[.7rem] text-white tracking-wide">Admin</span>
          <span class="text-[.62rem] text-white/30 leading-tight">Full control</span>
        </label>
      </div> -->
      </div>

      <form method="post" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- validation errors --}}
        @if ($errors->any())
        <div style="color: red;">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {{-- exceptions errors --}}
        @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
        @endif

        <!-- NAME ROW -->
        <!-- <div class="grid grid-cols-2 gap-3"> -->
        <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Fullname</label>
          <input type="text" placeholder="Fullname" autocomplete="given-name" name="fullname"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div>
        <!-- <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Last Name</label>
          <input type="text" placeholder="El Amrani" autocomplete="family-name"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div> -->
        <!-- </div> -->

        <!-- EMAIL -->
        <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Email Address</label>
          <input type="email" placeholder="you@example.com" autocomplete="email" name="email"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div>

        <!-- PHONE -->
        <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Phone Number</label>
          <input type="tel" placeholder="+212 6XX XXX XXX" autocomplete="tel" name="phone_number"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div>

        <!-- PASSWORD -->
        <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Password</label>
          <div class="relative">
            <input type="password" id="pw" placeholder="Min. 8 characters" autocomplete="new-password" name="password"
              oninput="checkStrength(this.value)"
              class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 pr-14 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
            <button type="button" onclick="togglePw()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/30 hover:text-white text-[.77rem] font-dm transition-colors">Show</button>
          </div>
          <!-- STRENGTH -->
          <div class="flex items-center gap-1.5 mt-2">
            <div id="b1" class="flex-1 h-[3px] rounded-full bg-neon/10 transition-all"></div>
            <div id="b2" class="flex-1 h-[3px] rounded-full bg-neon/10 transition-all"></div>
            <div id="b3" class="flex-1 h-[3px] rounded-full bg-neon/10 transition-all"></div>
            <span id="pwlbl" class="text-[.67rem] text-white/30 ml-1.5 min-w-[38px]"></span>
          </div>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
          <label class="block text-[.72rem] font-medium text-white/40 uppercase tracking-widest mb-2">Confirm Password</label>
          <input type="password" placeholder="Repeat password" autocomplete="new-password" name="password_confirmation"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-[.87rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div>

        <!-- TERMS -->
        <div class="flex items-start gap-3 pt-1">
          <input type="checkbox" name="is_adult" value="1">
          <label>I confirm I am 18 years or older</label>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="glow w-full bg-neon text-ink font-syne font-bold text-sm tracking-wider py-4 rounded-xl hover:opacity-90 hover:-translate-y-px transition-all">
          Create Account →
        </button>
      </form>

      <!-- DIVIDER -->
      <div class="flex items-center gap-3 my-5">
        <div class="flex-1 h-px bg-neon/10"></div>
        <span class="text-[.72rem] text-white/25 whitespace-nowrap">or sign up with</span>
        <div class="flex-1 h-px bg-neon/10"></div>
      </div>

      <!-- GOOGLE -->
      <button class="w-full flex items-center justify-center gap-2.5 bg-card border border-neon/10 rounded-xl py-3.5 font-syne font-semibold text-[.84rem] text-white hover:border-neon/25 hover:bg-[#181F1A] transition-all mb-6">
        <svg width="18" height="18" viewBox="0 0 24 24">
          <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
          <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
          <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
          <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
        </svg>
        Continue with Google
      </button>

      <p class="text-center text-[.82rem] text-white/35">
        Already have an account? <a href="{{ route('login.page') }}" class="text-neon font-semibold hover:opacity-80 transition-opacity">Sign in →</a>
      </p>
    </div>
  </div>

  <!-- RIGHT: INFO PANEL -->
  <div class="relative bg-surface border-l border-neon/10 flex flex-col justify-center px-16 py-20 overflow-hidden">
    <div class="absolute inset-0 field-grid pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 70% 50% at 100% 50%,rgba(61,255,122,.06) 0%,transparent 55%)"></div>

    <a href="home.html" class="relative z-10 font-bebas text-[2.2rem] tracking-[4px] text-neon no-underline mb-16">B<span class="text-white">ALL</span>e</a>

    <h2 class="relative z-10 font-bebas leading-[.92] tracking-wide text-white mb-6" style="font-size:clamp(2.8rem,4.5vw,5rem)">
      YOUR GAME<br>STARTS<br><span class="text-neon">HERE.</span>
    </h2>
    <p class="relative z-10 text-sm leading-7 text-white/35 max-w-[340px] mb-12">Create an account and unlock instant access to football pitches near you — no phone calls, no waiting lists.</p>

    <!-- TESTIMONIAL -->
    <div class="relative z-10 bg-card border border-neon/10 rounded-2xl p-6 max-w-[340px]">
      <div class="text-neon text-xs mb-3 tracking-widest">★★★★★</div>
      <p class="text-[.87rem] text-white/70 leading-7 mb-5 italic">
        <span class="text-neon not-italic text-lg leading-none align-[-3px] mr-1">"</span>BALLe saved us so much time. We used to spend 20 minutes calling around. Now we book in under a minute.
      </p>
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 bg-neon/10 border border-neon/20 rounded-full flex items-center justify-center font-syne font-bold text-[.82rem] text-neon flex-shrink-0">KM</div>
        <div>
          <div class="font-syne font-bold text-[.81rem] text-white">Client</div>
          <div class="text-[.7rem] text-white/30">Player · Casablanca</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePw() {
      const pw = document.getElementById('pw');
      const btn = document.querySelector('button[onclick="togglePw()"]');
      pw.type = pw.type === 'password' ? 'text' : 'password';
      btn.textContent = pw.type === 'password' ? 'Show' : 'Hide';
    }

    function checkStrength(val) {
      const b1 = document.getElementById('b1'),
        b2 = document.getElementById('b2'),
        b3 = document.getElementById('b3'),
        lbl = document.getElementById('pwlbl');
      const reset = '#3DFF7A1A';
      b1.style.background = b2.style.background = b3.style.background = reset;
      if (!val) {
        lbl.textContent = '';
        return;
      }
      const score = (val.length >= 8 ? 1 : 0) + ((/[A-Z]/.test(val) && /\d/.test(val)) ? 1 : 0) + (/[^a-zA-Z0-9]/.test(val) ? 1 : 0);
      if (score === 1) {
        b1.style.background = '#FF5757';
        lbl.textContent = 'Weak';
        lbl.style.color = '#FF5757';
      } else if (score === 2) {
        b1.style.background = '#FFB800';
        b2.style.background = '#FFB800';
        lbl.textContent = 'Medium';
        lbl.style.color = '#FFB800';
      } else {
        b1.style.background = '#3DFF7A';
        b2.style.background = '#3DFF7A';
        b3.style.background = '#3DFF7A';
        lbl.textContent = 'Strong';
        lbl.style.color = '#3DFF7A';
      }
    }
  </script>
</body>

</html>