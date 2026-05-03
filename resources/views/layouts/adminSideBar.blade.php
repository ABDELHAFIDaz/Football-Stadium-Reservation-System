<!-- SIDEBAR -->
<aside class="w-[230px] flex-shrink-0 bg-surface border-r border-neon/10 flex flex-col sticky top-0 h-screen">
  <div class="px-6 py-5 border-b border-neon/10">
    <a href="home.html" class="font-bebas text-2xl tracking-[4px] text-neon">B<span class="text-white">ALL</span>e</a>
    <div class="text-[.62rem] text-neon/50 font-semibold uppercase tracking-widest mt-0.5">Admin Panel</div>
  </div>
  <div class="px-5 py-5 border-b border-neon/10">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-neon/15 border border-neon/30 rounded-full flex items-center justify-center font-syne font-bold text-sm text-neon">AD</div>
      <div><div class="font-syne font-bold text-sm text-white">Cdm</div><div class="text-[.7rem] text-neon/60">Super Admin</div></div>
    </div>
  </div>
  <nav class="flex-1 px-3 py-5 flex flex-col gap-1">
    <a href="dashboard-admin.html" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-neon bg-neon/10 font-medium"><span>📊</span> Overview</a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all"><span>👥</span> Users</a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all"><span>🏟️</span> All Pitches</a>
    <!-- <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all"><span>📅</span> Reservations</a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all"><span>📈</span> Reports</a>
    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/40 hover:text-white hover:bg-card transition-all"><span>⚙️</span> System Settings</a> -->
  </nav>
  <div class="px-3 py-4 border-t border-neon/10">
    <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-white/30 hover:text-white/60 transition-all"><span>🚪</span> Sign Out</a>
  </div>
</aside>
