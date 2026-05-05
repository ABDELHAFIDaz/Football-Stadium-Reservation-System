@extends('layouts.app')

@section('title', 'adminDashboard')

@section('content')

<div class="bg-ink text-white flex min-h-screen">

  @include('layouts.adminSideBar')
  <!-- MAIN -->
  <main class="flex-1 px-10 py-8 overflow-y-auto">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
      <div>
        <div class="text-[.7rem] font-semibold text-neon uppercase tracking-widest mb-1">System-Wide</div>
        <h1 class="font-bebas text-4xl tracking-wide text-white">ADMIN OVERVIEW</h1>
      </div>
      <!-- <div class="flex items-center gap-3">
        <div class="text-xs text-white/35">Last refresh: <span class="text-white/60">Just now</span></div>
        <button class="bg-card border border-neon/10 text-white/50 text-xs px-4 py-2.5 rounded-xl hover:border-neon/25 hover:text-white transition-all">🔄 Refresh</button>
      </div> -->
    </div>

    <!-- TOP STATS -->
    <div class="grid grid-cols-4 gap-4 mb-8">
      <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
        <div class="flex items-start justify-between mb-3">
          <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-base">👥</div>
          <span class="text-[.65rem] text-neon font-syne font-bold bg-neon/10 px-2 py-0.5 rounded-full">Customers</span>
        </div>
        <div class="font-bebas text-4xl text-white">{{ $customersCounter }}</div>
        <div class="text-[.72rem] text-white/35 mt-1">Total Customers</div>
      </div>
      <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
        <div class="flex items-start justify-between mb-3">
          <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-base">👥</div>
          <span class="text-[.65rem] text-neon font-syne font-bold bg-neon/10 px-2 py-0.5 rounded-full">Managers</span>
        </div>
        <div class="font-bebas text-4xl text-white">{{ $managersCounter }}</div>
        <div class="text-[.72rem] text-white/35 mt-1">Total Managers</div>
      </div>
      <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
        <div class="flex items-start justify-between mb-3">
          <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-base">🏟️</div>
          <span class="text-[.65rem] text-neon font-syne font-bold bg-neon/10 px-2 py-0.5 rounded-full">Stadiums</span>
        </div>
        <div class="font-bebas text-4xl text-white">{{ $pitchesCounter }}</div>
        <div class="text-[.72rem] text-white/35 mt-1">Total Stadiums</div>
      </div>
      <div class="bg-card border border-neon/10 rounded-2xl px-5 py-5">
        <div class="flex items-start justify-between mb-3">
          <div class="w-9 h-9 bg-neon/10 border border-neon/15 rounded-xl flex items-center justify-center text-base">📅</div>
          <span class="text-[.65rem] text-neon font-syne font-bold bg-neon/10 px-2 py-0.5 rounded-full">Reservations</span>
        </div>
        <div class="font-bebas text-4xl text-white">{{ $reservationsCounter }}<span class="text-neon text-2xl"></span></div>
        <div class="text-[.72rem] text-white/35 mt-1">Total Reservations</div>
      </div>
    </div>

    <div class="grid gap-6">

      <!-- USERS TABLE -->
      <div class="col-span-2 flex flex-col gap-6">

        <!-- RECENT USERS -->
        <div>
          <div class="flex items-center justify-between mb-4">
            <div class="font-syne font-bold text-sm text-white">Recent Users</div>
            <div class="flex items-center gap-2">
              <a href="{{ route('admin.users') }}" class="text-xs text-neon hover:opacity-75 transition-opacity">Manage all →</a>
            </div>
          </div>
          <div class="bg-card border border-neon/10 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-neon/10 bg-surface/60">
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">User</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Role</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Phone number</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Reservations</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Status</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-neon/10">
                @foreach($users as $user)
                <tr class="hover:bg-surface/40 transition-colors">
                  <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                      <div class="w-7 h-7 bg-neon/10 border border-neon/15 rounded-full flex items-center justify-center text-[.65rem] font-bold text-neon">BALLe</div>
                      <div>
                        <div class="text-xs text-white font-medium">{{ $user->fullname }}</div>
                        <div class="text-[.68rem] text-white/30">{{ $user->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-5 py-3.5"><span class="
                @if($user->role == 'customer') text-[.65rem] text-neon bg-neon/10 px-2 py-0.5 rounded-full font-syne font-bold
                @elseif($user->role == 'manager') text-[.65rem] text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded-full font-syne font-bold @endif">{{ $user->role }}</span></td>
                  <td class="px-5 py-3.5 text-xs text-white/50">{{ $user->phone_number }}</td>
                  <td class="px-5 py-3.5 text-xs text-white/60">{{ count($user->reservations) }}</td>
                  @if($user->is_banned)
                  <td class="px-5 py-3.5"><span class="text-[.65rem] text-red-400 bg-red-500/10 px-2 py-0.5 rounded-full font-syne font-bold">Banned</span></td>
                  <td class="px-5 py-3.5">
                    <div class="flex gap-1.5">
                      <form action="{{ route('admin.toggle-ban', $user->id) }}" method="post" onsubmit="return confirm('Unban this user?')">@csrf<button class="text-[.65rem] text-neon/70 hover:text-neon border border-neon/10 hover:border-neon/25 px-2 py-0.5 rounded-lg transition-all">UnBan</button></form>
                    </div>
                  </td>
                  @else
                  <td class="px-5 py-3.5"><span class="text-[.65rem] text-neon bg-neon/10 px-2 py-0.5 rounded-full font-syne font-bold">Active</span></td>
                  <td class="px-5 py-3.5">
                    <div class="flex gap-1.5">
                      <form action="{{ route('admin.toggle-ban', $user->id) }}" method="post" onsubmit="return confirm('Ban this User?')">@csrf<button class="text-[.65rem] text-red-400/70 hover:text-red-400 border border-red-500/10 hover:border-red-400/25 px-2 py-0.5 rounded-lg transition-all">Ban</button></form>
                    </div>
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- ALL PITCHES (compact) -->
        <div>
          <div class="flex items-center justify-between mb-4">
            <div class="font-syne font-bold text-sm text-white">Recent Pitches</div>
            <a href="#" class="text-xs text-neon hover:opacity-75 transition-opacity">Manage all →</a>
          </div>
          <div class="bg-card border border-neon/10 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-neon/10 bg-surface/60">
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Pitch</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Manager</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">City</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Price/h</th>
                  <th class="text-left px-5 py-3 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-neon/10">
                @foreach($pitches as $pitch)
                <tr class="hover:bg-surface/40 transition-colors">
                  <td class="px-5 py-3 text-xs text-white/70">{{ $pitch->name }}</td>
                  <td class="px-5 py-3 text-xs text-white/50">{{ $pitch->user->fullname }}</td>
                  <td class="px-5 py-3 text-xs text-white/50">{{ $pitch->city->name }}</td>
                  <td class="px-5 py-3 text-xs text-neon">{{ $pitch->price_per_hour }}</td>
                  <td class="px-5 py-3"><span class="text-[.62rem] font-syne font-bold @if($pitch->status === 'available') text-neon bg-neon/10 px-2 py-0.5 rounded-full
                  @elseif($pitch->status === 'reserved') text-yellow-400 bg-yellow-500/10 px-2 py-0.5 rounded-full
                  @else text-red-400 bg-red-500/10 px-2 py-0.5 rounded-full @endif">{{ $pitch->status }}</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection