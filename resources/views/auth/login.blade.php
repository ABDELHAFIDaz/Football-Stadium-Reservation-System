<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BALLe – Sign In</title>
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

    .check-item::before {
      content: '';
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      border-radius: 50%;
      background: rgba(61, 255, 122, .12) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath d='M2 6l3 3 5-5' stroke='%233DFF7A' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat center;
      border: 1px solid rgba(61, 255, 122, .2);
    }

    .glow {
      box-shadow: 0 0 32px rgba(61, 255, 122, .2);
    }

    .glow:hover {
      box-shadow: 0 6px 40px rgba(61, 255, 122, .3);
    }
  </style>
</head>

<body class="bg-ink text-white min-h-screen grid grid-cols-2">

  <!-- LEFT: BRAND PANEL -->
  <div class="relative bg-surface border-r border-neon/10 flex flex-col justify-center px-16 py-20 overflow-hidden">
    <div class="absolute inset-0 field-grid pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 80% 50% at 0% 60%,rgba(61,255,122,.07) 0%,transparent 55%)"></div>
    <!-- Big deco -->
    <div class="absolute -bottom-6 -right-4 font-bebas text-[20rem] leading-none text-neon/[0.025] pointer-events-none select-none">⚽</div>

    <a href="home.html" class="relative z-10 font-bebas text-[2.2rem] tracking-[4px] text-neon no-underline mb-16">B<span class="text-white">ALL</span>e</a>

    <h1 class="relative z-10 font-bebas leading-[.92] tracking-wide text-white mb-6" style="font-size:clamp(3rem,5vw,5.2rem)">
      WELCOME<br>BACK TO<br><span class="text-neon">THE PITCH.</span>
    </h1>
    <p class="relative z-10 text-sm leading-7 text-white/35 max-w-[340px] mb-12">Sign in to manage your reservations, check availability, and stay on top of your game.</p>

    <ul class="relative z-10 flex flex-col gap-3.5">
      <li class="check-item flex items-center gap-3 text-[.84rem] text-white/40">Real-time pitch availability</li>
      <li class="check-item flex items-center gap-3 text-[.84rem] text-white/40">Instant booking confirmation</li>
      <li class="check-item flex items-center gap-3 text-[.84rem] text-white/40">Email notifications & reminders</li>
      <li class="check-item flex items-center gap-3 text-[.84rem] text-white/40">Easy cancellation & rescheduling</li>
    </ul>
  </div>

  <!-- RIGHT: FORM PANEL -->
  <div class="flex flex-col justify-center items-center px-16 py-20">
    <div class="w-full max-w-[390px] anim">

      <!-- HEADER -->
      <div class="mb-9">
        <div class="text-[.71rem] font-semibold text-neon uppercase tracking-[.14em] mb-2.5">Sign In</div>
        <h2 class="font-syne font-extrabold text-[1.85rem] text-white leading-tight">Access your account</h2>
        <p class="text-[.84rem] text-white/40 mt-2">Enter your credentials to continue.</p>
      </div>


      <form method="post" action="{{ route('login') }}" class="space-y-4">
        @csrf

        @if($errors->any())
        <div style="color: red;">
          @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach
        </div>
        @endif

        <!-- EMAIL -->
        <div>
          <label class="block text-[.74rem] font-medium text-white/40 uppercase tracking-widest mb-2">Email Address</label>
          <input type="email" placeholder="you@example.com" autocomplete="email" value="{{ old('email')}}" name="email"
            class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3.5 text-white text-[.88rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
        </div>

        <!-- PASSWORD -->
        <div>
          <label class="block text-[.74rem] font-medium text-white/40 uppercase tracking-widest mb-2">Password</label>
          <div class="relative">
            <input type="password" id="pw" placeholder="••••••••" autocomplete="current-password" name="password"
              class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3.5 pr-14 text-white text-[.88rem] font-dm outline-none placeholder-white/20 focus:border-neon/40 focus:ring-2 focus:ring-neon/5 transition-all">
            <button type="button" onclick="togglePw()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/30 hover:text-white text-[.78rem] font-dm transition-colors">Show</button>
          </div>
        </div>

        <!-- REMEMBER + FORGOT -->
        <div class="flex items-center justify-between pt-1">
          <label class="flex items-center gap-2.5 text-[.81rem] text-white/40 cursor-pointer">
            <input type="checkbox" class="w-4 h-4 accent-neon rounded cursor-pointer"> Remember me
          </label>
          <a href="#" class="text-[.81rem] text-neon hover:opacity-75 transition-opacity">Forgot password?</a>
        </div>

        <!-- SUBMIT -->
        <button type="submit" class="glow w-full bg-neon text-ink font-syne font-bold text-sm tracking-wider py-4 rounded-xl hover:opacity-90 hover:-translate-y-px transition-all mt-2">
          Sign In →
        </button>
      </form>

      <!-- DIVIDER -->
      <div class="flex items-center gap-3 my-6">
        <div class="flex-1 h-px bg-neon/10"></div>
        <span class="text-[.73rem] text-white/25 whitespace-nowrap">or continue with</span>
        <div class="flex-1 h-px bg-neon/10"></div>
      </div>

      <!-- GOOGLE -->
      <!-- <button class="w-full flex items-center justify-center gap-2.5 bg-card border border-neon/10 rounded-xl py-3.5 font-syne font-semibold text-[.84rem] text-white hover:border-neon/25 hover:bg-[#181F1A] transition-all mb-7">
        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
          <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
          <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
          <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
        </svg>
        Sign in with Google
      </button> -->

      <p class="text-center text-[.82rem] text-white/35">
        Don't have an account? <a href="{{ route('signup') }}" class="text-neon font-semibold hover:opacity-80 transition-opacity">Create one →</a>
      </p>
    </div>
  </div>

  <script>
    function togglePw() {
      const pw = document.getElementById('pw');
      const btn = document.querySelector('button[onclick="togglePw()"]');
      pw.type = pw.type === 'password' ? 'text' : 'password';
      btn.textContent = pw.type === 'password' ? 'Show' : 'Hide';
    }
  </script>
</body>

</html>