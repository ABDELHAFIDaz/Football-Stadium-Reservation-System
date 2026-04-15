<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BALLe – My Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<script>tailwind.config={theme:{extend:{colors:{neon:'#3DFF7A',ink:'#060A07',surface:'#0C1210',card:'#131A15'},fontFamily:{bebas:['Bebas Neue','sans-serif'],syne:['Syne','sans-serif'],dm:['DM Sans','sans-serif']}}}}</script>
<style>body{font-family:'DM Sans',sans-serif;}</style>
</head>
<body class="bg-ink text-white flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-[230px] flex-shrink-0 bg-surface border-r border-neon/10 flex flex-col sticky top-0 h-screen">
  <div class="px-6 py-5 border-b border-neon/10">
    <a href="home.html" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>
  </div>

  <!-- USER -->
  <div class="px-5 py-5 border-b border-neon/10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-neon/10 border border-neon/20 rounded-full flex items-center justify-center font-syne font-bold text-sm text-neon">YE</div>
      <div><div class="font-syne font-bold text-sm text-white">Youssef El Amrani</div><div class="text-[.7rem] text-white/35">Player</div></div>
    </div>
  </div>

  <nav class="flex-1 px-3 py-5 flex flex-col gap-1">
    <a href="dashboard-user.html" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-neon bg-neon/10 font-medium">
      <span>🏠</span> Dashboard
    </a>
    <a href="pitches.html" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all">
      <span>🔍</span> Browse Pitches
    </a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all">
      <span>📅</span> My Bookings
    </a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all">
      <span>❤️</span> Favorites
    </a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all">
      <span>⚙️</span> Settings
    </a>
  </nav>

  <div class="px-3 py-5 border-t border-neon/10">
    <a href="login.html" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/30 hover:text-white/60 transition-all">
      <span>🚪</span> Sign Out
    </a>
  </div>
</aside>

<!-- MAIN -->
<main class="flex-1 px-10 py-8 overflow-y-auto">

  <!-- HEADER -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <div class="text-[.7rem] font-semibold text-neon uppercase tracking-widest mb-1">Welcome back</div>
      <h1 class="font-bebas text-4xl tracking-wide text-white">YOUSSEF'S DASHBOARD</h1>
    </div>
    <a href="pitches.html" class="bg-neon text-ink font-syne font-bold text-sm tracking-wider px-6 py-3 rounded-xl hover:opacity-90 transition-all" style="box-shadow:0 0 24px rgba(61,255,122,.2)">+ Book a Pitch</a>
  </div>

  <!-- STATS -->
  <div class="grid grid-cols-4 gap-4 mb-8">
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Total Bookings</div>
      <div class="font-bebas text-4xl text-white">12<span class="text-neon">+</span></div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">This Month</div>
      <div class="font-bebas text-4xl text-white">3</div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Hours Played</div>
      <div class="font-bebas text-4xl text-white">18<span class="text-neon">h</span></div>
    </div>
    <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
      <div class="text-white/35 text-xs uppercase tracking-widest mb-2">Total Spent</div>
      <div class="font-bebas text-4xl text-white">2.4<span class="text-neon">K</span></div>
    </div>
  </div>

  <div class="grid grid-cols-3 gap-6">

    <!-- UPCOMING BOOKINGS -->
    <div class="col-span-2">
      <div class="flex items-center justify-between mb-4">
        <div class="font-syne font-bold text-sm text-white">Upcoming Reservations</div>
        <a href="#" class="text-xs text-neon hover:opacity-75 transition-opacity">View all →</a>
      </div>
      <div class="flex flex-col gap-3">

        <!-- Booking card -->
        <div class="bg-card border border-neon/15 rounded-2xl p-5">
          <div class="flex items-start justify-between">
            <div class="flex gap-4">
              <div class="w-12 h-12 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-xl">🏟️</div>
              <div>
                <div class="font-syne font-bold text-sm text-white">Stade Al Fath</div>
                <div class="text-[.72rem] text-white/40 mt-0.5">📍 Casablanca, Maarif</div>
                <div class="flex items-center gap-3 mt-2">
                  <span class="text-[.72rem] text-white/50">📅 April 5, 2025</span>
                  <span class="text-[.72rem] text-white/50">⏰ 18:00 – 19:00</span>
                  <span class="text-[.72rem] text-white/50">5-a-side</span>
                </div>
              </div>
            </div>
            <div class="text-right">
              <div class="bg-neon/10 text-neon text-[.65rem] font-syne font-bold px-2.5 py-1 rounded-full border border-neon/20 mb-2">CONFIRMED</div>
              <div class="font-syne font-bold text-neon text-sm">165 MAD</div>
            </div>
          </div>
          <div class="flex gap-2 mt-4 pt-4 border-t border-neon/10">
            <button class="text-xs text-white/40 hover:text-white border border-neon/10 hover:border-neon/25 px-4 py-1.5 rounded-lg transition-all">Modify</button>
            <button class="text-xs text-red-400/70 hover:text-red-400 border border-red-500/10 hover:border-red-400/30 px-4 py-1.5 rounded-lg transition-all">Cancel</button>
          </div>
        </div>

        <div class="bg-card border border-neon/10 rounded-2xl p-5">
          <div class="flex items-start justify-between">
            <div class="flex gap-4">
              <div class="w-12 h-12 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-xl">⚽</div>
              <div>
                <div class="font-syne font-bold text-sm text-white">Terrain Anfa Sport</div>
                <div class="text-[.72rem] text-white/40 mt-0.5">📍 Casablanca, Anfa</div>
                <div class="flex items-center gap-3 mt-2">
                  <span class="text-[.72rem] text-white/50">📅 April 9, 2025</span>
                  <span class="text-[.72rem] text-white/50">⏰ 20:00 – 21:30</span>
                  <span class="text-[.72rem] text-white/50">7-a-side</span>
                </div>
              </div>
            </div>
            <div class="text-right">
              <div class="bg-yellow-500/10 text-yellow-400 text-[.65rem] font-syne font-bold px-2.5 py-1 rounded-full border border-yellow-500/20 mb-2">PENDING</div>
              <div class="font-syne font-bold text-neon text-sm">315 MAD</div>
            </div>
          </div>
          <div class="flex gap-2 mt-4 pt-4 border-t border-neon/10">
            <button class="text-xs text-white/40 hover:text-white border border-neon/10 hover:border-neon/25 px-4 py-1.5 rounded-lg transition-all">Modify</button>
            <button class="text-xs text-red-400/70 hover:text-red-400 border border-red-500/10 hover:border-red-400/30 px-4 py-1.5 rounded-lg transition-all">Cancel</button>
          </div>
        </div>

      </div>

      <!-- PAST BOOKINGS -->
      <div class="mt-7">
        <div class="font-syne font-bold text-sm text-white mb-4">Recent History</div>
        <div class="bg-card border border-neon/10 rounded-2xl overflow-hidden">
          <table class="w-full text-sm">
            <thead><tr class="border-b border-neon/10"><th class="text-left px-5 py-3 text-[.7rem] text-white/35 font-semibold uppercase tracking-widest">Pitch</th><th class="text-left px-5 py-3 text-[.7rem] text-white/35 font-semibold uppercase tracking-widest">Date</th><th class="text-left px-5 py-3 text-[.7rem] text-white/35 font-semibold uppercase tracking-widest">Duration</th><th class="text-left px-5 py-3 text-[.7rem] text-white/35 font-semibold uppercase tracking-widest">Amount</th><th class="text-left px-5 py-3 text-[.7rem] text-white/35 font-semibold uppercase tracking-widest">Status</th></tr></thead>
            <tbody class="divide-y divide-neon/10">
              <tr class="hover:bg-surface/50 transition-colors"><td class="px-5 py-3.5 text-white/70">Stade Al Fath</td><td class="px-5 py-3.5 text-white/50">Mar 28</td><td class="px-5 py-3.5 text-white/50">1h</td><td class="px-5 py-3.5 text-white/70">165 MAD</td><td class="px-5 py-3.5"><span class="text-[.65rem] font-syne font-bold text-neon bg-neon/10 px-2 py-0.5 rounded-full">Done</span></td></tr>
              <tr class="hover:bg-surface/50 transition-colors"><td class="px-5 py-3.5 text-white/70">Complexe Raja</td><td class="px-5 py-3.5 text-white/50">Mar 20</td><td class="px-5 py-3.5 text-white/50">2h</td><td class="px-5 py-3.5 text-white/70">715 MAD</td><td class="px-5 py-3.5"><span class="text-[.65rem] font-syne font-bold text-neon bg-neon/10 px-2 py-0.5 rounded-full">Done</span></td></tr>
              <tr class="hover:bg-surface/50 transition-colors"><td class="px-5 py-3.5 text-white/70">Anfa Sport</td><td class="px-5 py-3.5 text-white/50">Mar 14</td><td class="px-5 py-3.5 text-white/50">1h</td><td class="px-5 py-3.5 text-white/70">215 MAD</td><td class="px-5 py-3.5"><span class="text-[.65rem] font-syne font-bold text-red-400 bg-red-500/10 px-2 py-0.5 rounded-full">Cancelled</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="flex flex-col gap-5">
      <!-- QUICK BOOK -->
      <div class="bg-card border border-neon/10 rounded-2xl p-5">
        <div class="font-syne font-bold text-sm text-white mb-4">Quick Book</div>
        <div class="flex flex-col gap-2.5">
          <input type="text" placeholder="🏙️ City" class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white text-xs outline-none placeholder-white/25 focus:border-neon/35 transition-all">
          <input type="date" class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white/50 text-xs outline-none focus:border-neon/35 transition-all">
          <select class="w-full bg-surface border border-neon/10 rounded-xl px-3 py-2.5 text-white/50 text-xs outline-none focus:border-neon/35 transition-all"><option disabled selected>Format</option><option>5-a-side</option><option>7-a-side</option><option>11-a-side</option></select>
        </div>
        <a href="pitches.html" class="mt-3 block w-full text-center bg-neon text-ink font-syne font-bold text-xs tracking-wider py-2.5 rounded-xl hover:opacity-90 transition-opacity">Search →</a>
      </div>

      <!-- FAVORITES -->
      <div class="bg-card border border-neon/10 rounded-2xl p-5">
        <div class="font-syne font-bold text-sm text-white mb-4">Favorites</div>
        <div class="flex flex-col gap-3">
          <a href="pitch-detail.html" class="flex items-center gap-3 hover:bg-surface rounded-xl px-2 py-1.5 transition-colors -mx-2">
            <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-lg flex items-center justify-center text-base">🏟️</div>
            <div class="flex-1 min-w-0"><div class="font-syne font-semibold text-xs text-white truncate">Stade Al Fath</div><div class="text-[.65rem] text-white/35">Casablanca · 150 MAD/h</div></div>
            <span class="text-neon text-xs">→</span>
          </a>
          <a href="pitch-detail.html" class="flex items-center gap-3 hover:bg-surface rounded-xl px-2 py-1.5 transition-colors -mx-2">
            <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-lg flex items-center justify-center text-base">⚽</div>
            <div class="flex-1 min-w-0"><div class="font-syne font-semibold text-xs text-white truncate">Complexe Raja</div><div class="text-[.65rem] text-white/35">Rabat · 350 MAD/h</div></div>
            <span class="text-neon text-xs">→</span>
          </a>
        </div>
      </div>

      <!-- PROFILE CARD -->
      <div class="bg-card border border-neon/10 rounded-2xl p-5">
        <div class="font-syne font-bold text-sm text-white mb-4">Profile</div>
        <div class="flex flex-col gap-2.5 text-xs">
          <div class="flex justify-between"><span class="text-white/35">Name</span><span class="text-white">Youssef El Amrani</span></div>
          <div class="flex justify-between"><span class="text-white/35">Email</span><span class="text-white/70">youssef@email.com</span></div>
          <div class="flex justify-between"><span class="text-white/35">Phone</span><span class="text-white/70">+212 612 345 678</span></div>
          <div class="flex justify-between"><span class="text-white/35">Role</span><span class="text-neon font-semibold">Player</span></div>
          <div class="flex justify-between"><span class="text-white/35">Member since</span><span class="text-white/70">Jan 2025</span></div>
        </div>
        <button class="mt-4 w-full text-xs text-white/35 border border-neon/10 hover:border-neon/25 hover:text-white py-2 rounded-xl transition-all">Edit Profile</button>
      </div>
    </div>
  </div>
</main>
</body>
</html>