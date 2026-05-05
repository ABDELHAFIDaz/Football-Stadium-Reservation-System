<aside class="w-[280px] h-screen sticky top-0 flex-shrink-0 bg-[#0b120f] border-r border-white/5 flex flex-col">
    <!-- Top Section: Logo & Nav -->
    <div class="flex-1">
        <div class="px-8 py-6">
            <a href="#" class="font-bebas text-3xl tracking-[4px] text-[#3dff7a]">B<span class="text-white">ALL</span>e</a>
            <div class="text-[.6rem] text-[#3dff7a]/50 font-bold uppercase tracking-[2px] mt-1">Manager Portal</div>
        </div>

        <nav class="px-4 mt-6 flex flex-col gap-2">
            <a href="{{ route('manager.dashboard') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-syne font-bold transition-all {{ request()->routeIs('manager.dashboard') ? 'bg-[#3dff7a]/10 text-[#3dff7a]' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                <span class="text-lg">📊</span> Overview
            </a>
            <a href="{{ route('manager.reservations') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-syne font-bold text-white/40 hover:text-white hover:bg-white/5 transition-all">
                <span class="text-lg">📅</span> Reservations
            </a>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-syne font-bold text-white/40 hover:text-white hover:bg-white/5 transition-all">
                <span class="text-lg">🏟️</span> My Stadiums
            </a>
        </nav>
    </div>

    <!-- Bottom Section: Profile & Sign Out -->
    <div class="p-4 flex flex-col gap-2">
        <!-- Profile Card -->
        <div class="p-5 rounded-2xl bg-[#070b09] border border-white/5">
            <div class="text-[0.6rem] text-[#3dff7a] uppercase font-bold tracking-widest mb-3">Contact Info</div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-white text-xs font-medium truncate">{{ auth()->user()->email }}</div>
                <div class="text-white/40 text-[0.7rem]">{{ auth()->user()->phone_number ?? 'No phone' }}</div>
            </div>
            <button onclick="openModal()"
                class="w-full py-2.5 bg-[#3dff7a]/10 border border-[#3dff7a]/20 text-[#3dff7a] text-[0.65rem] font-bold rounded-xl hover:bg-[#3dff7a] hover:text-[#0b120f] transition-all uppercase tracking-tight">
                Edit Profile
            </button>
        </div>

        <!-- Sign Out Button -->
            @csrf
            <a href="{{ route('logout') }}"
                class="w-full flex items-center justify-center gap-2 px-4 py-3 text-red-400/60 hover:text-red-400 hover:bg-red-500/5 rounded-xl text-xs font-bold transition-all uppercase tracking-widest">
                <span>🚪</span> Sign Out
            </a>
    </div>
</aside>
@include('layouts.editProfileModal')

<script>
    function openModal() {
        document.getElementById('profileModal').classList.remove('hidden');
      }
    
      function closeModal() {
        document.getElementById('profileModal').classList.add('hidden');
      }
</script>
