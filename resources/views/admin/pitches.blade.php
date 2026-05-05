@extends('layouts.app')

@section('title', 'Pitches Management')

@section('content')
<div class="bg-ink text-white flex min-h-screen">
    @include('layouts.adminSideBar')

    <main class="flex-1 px-10 py-8 overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-bebas text-4xl tracking-wide text-white">PITCH MANAGEMENT</h1>
            </div>
            <!-- FILTER & SEARCH BAR -->
            <form action="{{ route('admin.pitches') }}" method="GET" class="flex flex-wrap items-center gap-4 bg-card border border-neon/10 p-4 rounded-2xl mb-8">
                <!-- Name Search -->
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stadium name..."
                        class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40 transition-all">
                </div>

                <!-- City Filter -->
                <select name="city_id" class="bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    <option value="">All Cities</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                    @endforeach
                </select>

                <!-- Status Filter -->
                <select name="status" class="bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    <option value="">All Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>

                <button type="submit" class="bg-neon text-ink font-syne font-bold text-xs px-6 py-2.5 rounded-xl hover:opacity-90 transition-all">
                    FILTER PITCHES
                </button>

                @if(request()->anyFilled(['search', 'city_id', 'status']))
                <a href="{{ route('admin.pitches') }}" class="text-xs text-white/30 hover:text-white transition-colors">Clear All</a>
                @endif
            </form>
            <button onclick="toggleModal('addPitchModal')" class="bg-neon text-ink font-syne font-bold text-xs px-6 py-2.5 rounded-xl hover:opacity-90 transition-all">
                + ADD NEW PITCH
            </button>
        </div>

        <!-- PITCHES TABLE -->
        <div class="bg-card border border-neon/10 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-neon/10 bg-surface/60">
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Pitch Name</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">City</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Price/h</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Status</th>
                        <th class="text-right px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neon/10">
                    @foreach($pitches as $pitch)
                    <tr class="hover:bg-surface/40 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm text-white font-medium">{{ $pitch->name }}</div>
                            <div class="text-[.7rem] text-white/30">{{ $pitch->address }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs text-white/50">{{ $pitch->city->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-xs text-neon font-bold">{{ $pitch->price_per_hour }} MAD</td>
                        <td class="px-6 py-4">
                            <span class="text-[.6rem] px-2 py-0.5 rounded-full font-bold uppercase @if($pitch->status == 'available') bg-neon/10 text-neon @elseif($pitch->status == 'unavailable') bg-red-500/10 text-red-400 @else bg-yellow-500/10 text-yellow-400 @endif">
                                {{ $pitch->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick="openEditModal({{ $pitch }})" class="text-[.65rem] text-white/40 border border-neon/10 px-3 py-1 rounded-lg hover:text-white transition-all">Edit</button>
                                <form action="{{ route('admin.removeStad', $pitch) }}" method="POST" onsubmit="return confirm('Delete this pitch?')">
                                    @csrf @method('DELETE')
                                    <button class="text-[.65rem] text-red-400/70 border border-red-500/10 px-3 py-1 rounded-lg hover:text-red-400 transition-all">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

@include('layouts.pitchesModals')

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }

    function openEditModal(pitch) {
        const form = document.getElementById('editPitchForm');
        form.action = `/admin/pitches/${pitch.id}`;
        document.getElementById('edit_name').value = pitch.name;
        toggleModal('editPitchModal');
    }

    function openEditModal(pitch) {
        const form = document.getElementById('editPitchForm');
        form.action = `/editStad/${pitch.id}`;

        // Fill basic fields
        document.getElementById('edit_name').value = pitch.name;
        document.getElementById('edit_price').value = pitch.price_per_hour;
        document.getElementById('edit_status').value = pitch.status;

        toggleModal('editPitchModal');
    }

    function toggleUnavailableInputs(value) {
        const container = document.getElementById('unavailable_dates_container');
        if (value === 'unavailable') {
            container.classList.remove('hidden');
            // Optional: Set default start date to today
            document.getElementById('edit_unavailable_from').valueAsDate = new Date();
        } else {
            container.classList.add('hidden');
            // Clear values if switched back to available
            document.getElementById('edit_unavailable_from').value = '';
            document.getElementById('edit_unavailable_until').value = '';
        }
    }
</script>
@endsection