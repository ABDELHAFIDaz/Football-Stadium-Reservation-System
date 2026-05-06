@extends('layouts.app')

@section('title', 'Manager Reservations')

@section('content')
<div class="flex min-h-screen bg-[#070b09]">
    @include('layouts.managerSidebar')

    <main class="flex-1 px-10 py-8">
        <!-- HEADER & FILTERS -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="font-bebas text-4xl text-white tracking-wide uppercase">All <span class="text-[#3dff7a]">Reservations</span></h1>
                <p class="text-white/30 text-[0.65rem] font-syne uppercase tracking-widest mt-1">Manage and filter your booking history</p>
            </div>

            <!-- FILTER FORM -->
            <form action="{{ route('manager.reservations') }}" method="GET" class="flex gap-4 items-end">
                <!-- Status Filter -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[0.6rem] text-white/40 uppercase font-bold tracking-tight">Status</label>
                    <select name="status" onchange="this.form.submit()" class="bg-[#0b120f] border border-white/10 text-white/70 text-xs rounded-xl px-4 py-2.5 outline-none focus:border-[#3dff7a]/40">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                </div>

                <!-- Stadium Filter -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[0.6rem] text-white/40 uppercase font-bold tracking-tight">Stadium</label>
                    <select name="stadium_id" onchange="this.form.submit()" class="bg-[#0b120f] border border-white/10 text-white/70 text-xs rounded-xl px-4 py-2.5 outline-none focus:border-[#3dff7a]/40">
                        <option value="">All My Stadiums</option>
                        @foreach($myStadiums as $stad)
                        <option value="{{ $stad->id }}" {{ request('stadium_id') == $stad->id ? 'selected' : '' }}>{{ $stad->name }}</option>
                        @endforeach
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
            </form>
        </div>

        <!-- RESERVATIONS TABLE -->
        <div class="bg-[#0b120f] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5">
                    <tr class="text-white/30 text-[0.65rem] uppercase font-bold tracking-widest border-b border-white/5">
                        <th class="px-6 py-5">Customer</th>
                        <th class="px-6 py-5">Stadium</th>
                        <th class="px-6 py-5">Customer Phone</th>
                        <th class="px-6 py-5">Date/Time</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($reservations as $res)
                    @php
                    $statusColors = [
                    'pending' => 'bg-orange-500/10 text-orange-400',
                    'confirmed' => 'bg-[#3dff7a]/10 text-[#3dff7a]',
                    'canceled' => 'bg-red-500/10 text-red-400',
                    'ended' => 'bg-white/10 text-white/40',
                    ];
                    @endphp
                    <tr class="hover:bg-white/[0.02] transition-all">
                        <td class="px-6 py-5 text-sm text-white font-medium">{{ $res->user->fullname }}</td>
                        <td class="px-6 py-5 text-sm text-white/80">{{ $res->stadium->name }}</td>
                        <td class="px-6 py-5 text-xs text-white/40">{{ $res->user->phone_number ?? 'N/A' }}</td>
                        <td class="px-6 py-5 text-xs text-white/60">
                            {{ $res->reservation_date->format('Y-M-d') }} <span class="text-[#3dff7a]/30 mx-1">|</span> {{ $res->start_time->format('H:i') }} - {{ $res->end_time->format('H:i') }}
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-[0.6rem] px-2 py-1 rounded font-bold uppercase {{ $statusColors[$res->status] ?? 'bg-white/5 text-white/30' }}">
                                {{ $res->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-3">
                                @if(in_array($res->status, ['pending', 'confirmed']))

                                @if($res->status == 'pending')
                                <form action="{{ route('reservation.confirm', $res->id) }}" method="POST" onsubmit="return confirm('Do you want to confirm it?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-xs font-bold text-[#3dff7a] hover:underline">Confirm</button>
                                </form>
                                @endif

                                <form action="{{ route('reservation.cancel', $res->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-xs font-bold text-red-400/60 hover:text-red-400">Cancel</button>
                                </form>
                                @else
                                {{-- This shows for 'cancelled', 'completed', etc. --}}
                                <span>-</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-white/20 font-syne uppercase tracking-widest text-xs">
                            No reservations found for these filters.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $reservations->links() }}
        </div>
    </main>
</div>
@endsection