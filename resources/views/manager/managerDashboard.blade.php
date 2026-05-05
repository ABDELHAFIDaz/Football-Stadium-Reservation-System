@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[#070b09]">

    @include('layouts.managerSidebar')

    <main class="flex-1 px-10 py-8">

        <div class="mb-10">
            <h1 class="font-bebas text-4xl text-white tracking-wide">DASHBOARD <span class="text-[#3dff7a]">OVERVIEW</span></h1>
            <p class="text-white/30 text-xs font-syne uppercase tracking-widest mt-1">Welcome back, {{ auth()->user()->fullname }}</p>
        </div>

        <div class="grid grid-cols-4 gap-6 mb-10">
            @php
            $cards = [
            ['label' => 'Ended Reservations', 'value' => $stats['ended'], 'color' => 'text-white'],
            ['label' => 'Confirmed', 'value' => $stats['confirmed'], 'color' => 'text-[#3dff7a]'],
            ['label' => 'Pending', 'value' => $stats['pending'], 'color' => 'text-orange-400'],
            ['label' => 'Total Earned', 'value' => number_format($stats['total_earned']) . ' MAD', 'color' => 'text-[#3dff7a] shadow-neon'],
            ];
            @endphp

            @foreach($cards as $card)
            <div class="bg-[#0b120f] border border-white/5 p-6 rounded-2xl">
                <div class="text-white/30 text-[0.6rem] uppercase font-bold tracking-widest mb-2">{{ $card['label'] }}</div>
                <div class="text-3xl font-bebas tracking-wider {{ $card['color'] }}">{{ $card['value'] }}</div>
            </div>
            @endforeach
        </div>

        <div class="mb-10">
            <h2 class="text-white font-bebas text-2xl mb-4 tracking-wider uppercase">Recent Reservations</h2>
            <div class="bg-[#0b120f] border border-white/5 rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/5">
                        <tr class="text-white/30 text-[0.65rem] uppercase font-bold tracking-widest border-b border-white/5">
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Stadium</th>
                            <th class="px-6 py-4">Customer Phone</th>
                            <th class="px-6 py-4">Date/Time</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($reservations as $res)
                        <tr class="hover:bg-white/[0.02] transition-all">
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $res->user->fullname }}</td>
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $res->stadium->name }}</td>
                            <td class="px-6 py-4 text-xs text-white/40">{{ $res->user->phone_number }}</td>
                            <td class="px-6 py-4 text-xs text-white/40">{{ $res->reservation_date->format('Y-M-d') }} <span class="text-[#3dff7a]/50 mx-1">|</span> {{ $res->start_time->format('H:i') }} - {{ $res->end_time->format('H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="text-[0.6rem] px-2 py-1 rounded font-bold uppercase 
    @switch($res->status)
        @case('pending') bg-orange-500/10 text-orange-400 @break
        @case('confirmed') bg-[#3dff7a]/10 text-[#3dff7a] @break
        @case('canceled') bg-red-500/10 text-red-400 @break
        @case('ended') bg-white/10 text-white/50 @break
        @default bg-white/5 text-white/30
    @endswitch">
                                    {{ $res->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h2 class="text-white font-bebas text-2xl mb-4 tracking-wider uppercase">My Stadium Inventory</h2>
            <div class="bg-[#0b120f] border border-white/5 rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/5">
                        <tr class="text-white/30 text-[0.65rem] uppercase font-bold tracking-widest border-b border-white/5">
                            <th class="px-6 py-4">Stadium Name</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Management</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($stadiums as $stad)
                        <tr class="hover:bg-white/[0.02] transition-all">
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $stad->name }}</td>
                            <td class="px-6 py-4 text-xs text-white/40">{{ $stad->address }}</td>
                            <td class="px-6 py-4">
                                <span class="text-[0.6rem] font-bold uppercase {{ $stad->status == 'available' ? 'text-[#3dff7a]' : 'text-red-500' }}">
                                    ● {{ $stad->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openEditModal({{ $stad }})" 
                                    class="bg-white/5 border border-white/10 text-white text-[0.65rem] px-4 py-2 rounded-xl font-bold hover:bg-[#3dff7a] hover:text-[#0b120f] transition-all">
                                    EDIT
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

@include('layouts.editPitchModal')

@endsection

@section('scripts')
<script src="{{ asset('js/editStadium.js') }}" defer></script>
@endsection