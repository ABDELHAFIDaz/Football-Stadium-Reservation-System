@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#070b09]">
    @include('layouts.managerSidebar')

    <main class="flex-1 px-10 py-8">
        <!-- HEADER & FILTERS -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="font-bebas text-4xl text-white tracking-wide uppercase">My <span class="text-[#3dff7a]">Stadiums</span></h1>
                <p class="text-white/30 text-[0.65rem] font-syne uppercase tracking-widest mt-1">Manage your pitch inventory and availability</p>
            </div>

            <!-- FILTER FORM -->
            <form action="{{ route('manager.stadiums') }}" method="GET" class="flex gap-4 items-end">
                <!-- Search Name -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[0.6rem] text-white/40 uppercase font-bold tracking-tight">Search Name</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Stadium name..." 
                           class="bg-[#0b120f] border border-white/10 text-white text-xs rounded-xl px-4 py-2.5 outline-none focus:border-[#3dff7a]/40 w-48">
                </div>

                <!-- Status Filter -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[0.6rem] text-white/40 uppercase font-bold tracking-tight">Status</label>
                    <select name="status" onchange="this.form.submit()" class="bg-[#0b120f] border border-white/10 text-white/70 text-xs rounded-xl px-4 py-2.5 outline-none focus:border-[#3dff7a]/40">
                        <option value="">All Statuses</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[0.6rem] text-white/40 uppercase font-bold tracking-tight">Sort By</label>
                    <select name="sort" onchange="this.form.submit()" class="bg-[#0b120f] border border-white/10 text-white/70 text-xs rounded-xl px-4 py-2.5 outline-none focus:border-[#3dff7a]/40">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>
                
                <button type="submit" class="bg-[#3dff7a]/10 border border-[#3dff7a]/20 p-2.5 rounded-xl text-[#3dff7a]">
                    🔍
                </button>
            </form>
        </div>

        <!-- STADIUMS TABLE -->
        <div class="bg-[#0b120f] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5">
                    <tr class="text-white/30 text-[0.65rem] uppercase font-bold tracking-widest border-b border-white/5">
                        <th class="px-6 py-5">Stadium Name</th>
                        <th class="px-6 py-5">Location</th>
                        <th class="px-6 py-5">Price/Hour</th>
                        <th class="px-6 py-5">Operating Hours</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5 text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($stadiums as $stad)
                    <tr class="hover:bg-white/[0.02] transition-all">
                        <td class="px-6 py-5 text-sm text-white font-medium">{{ $stad->name }}</td>
                        <td class="px-6 py-5 text-xs text-white/40">{{ $stad->address }}</td>
                        <td class="px-6 py-5 text-sm text-[#3dff7a] font-bold">{{ number_format($stad->price_per_hour) }} MAD</td>
                        <td class="px-6 py-5 text-xs text-white/60 uppercase">
                            {{ ($stad->open_from)->format('H:i') }} - {{ ($stad->open_until)->format('H:i') }}
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-[0.6rem] font-bold uppercase {{ $stad->status == 'available' ? 'text-[#3dff7a]' : 'text-red-500' }}">
                                ● {{ $stad->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button onclick="openEditModal({{ $stad }})" 
                                    class="bg-white/5 border border-white/10 text-white text-[0.65rem] px-5 py-2 rounded-xl font-bold hover:bg-[#3dff7a] hover:text-[#0b120f] transition-all uppercase">
                                Edit Pitch
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-white/20 font-syne uppercase tracking-widest text-xs">
                            No stadiums found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $stadiums->links() }}
        </div>
    </main>
</div>

<!-- Include your existing modal component here -->
@include('layouts.editPitchModal') 
@endsection

@section('scripts')
<script src="{{ asset('js/editStadium.js') }}" defer></script>