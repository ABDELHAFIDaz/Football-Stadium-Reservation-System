@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="bg-ink text-white flex min-h-screen"> 
    @include('layouts.adminSideBar')

    <main class="flex-1 px-10 py-8 overflow-y-auto">
        <!-- HEADER & FILTERS -->
        <div class="flex flex-col gap-6 mb-8">
            <div>
                <div class="text-[.7rem] font-semibold text-neon uppercase tracking-widest mb-1">Management</div>
                <h1 class="font-bebas text-4xl tracking-wide text-white">USER DIRECTORY</h1>
            </div>

            <!-- FILTER BAR -->
            <form action="{{ route('admin.users') }}" method="GET" class="flex flex-wrap items-center gap-4 bg-card border border-neon/10 p-4 rounded-2xl">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." 
                           class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40 transition-all">
                </div>
                
                <select name="status" class="bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Only</option>
                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned Only</option>
                </select>

                <select name="sort" class="bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>

                <button type="submit" class="bg-neon text-ink font-syne font-bold text-xs px-6 py-2.5 rounded-xl hover:opacity-90 transition-all">
                    APPLY FILTERS
                </button>
                <a href="{{ route('admin.users') }}" class="text-xs text-white/30 hover:text-white transition-colors">Clear</a>
            </form>
        </div>

        <!-- USERS TABLE -->
        <div class="bg-card border border-neon/10 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-neon/10 bg-surface/60">
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">User Details</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Role</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Joined</th>
                        <th class="text-left px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Status</th>
                        <th class="text-right px-6 py-4 text-[.67rem] text-white/35 font-semibold uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neon/10">
                    @forelse($users as $user)
                    <tr class="hover:bg-surface/40 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 {{ $user->is_banned ? 'bg-red-500/10 text-red-400' : 'bg-neon/10 text-neon' }} border border-current/20 rounded-full flex items-center justify-center text-[.7rem] font-bold">
                                    {{ strtoupper(substr($user->fullname, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="text-sm text-white font-medium">{{ $user->fullname }}</div>
                                    <div class="text-[.7rem] text-white/30">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[.65rem] {{ $user->role === 'admin' ? 'text-purple-400 bg-purple-400/10' : ($user->role === 'manager' ? 'text-blue-400 bg-blue-400/10' : 'text-neon bg-neon/10') }} px-2 py-0.5 rounded-full font-syne font-bold uppercase">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-white/50">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->is_banned)
                                <span class="text-[.65rem] text-red-400 bg-red-400/10 px-2 py-0.5 rounded-full font-syne font-bold uppercase">Banned</span>
                            @else
                                <span class="text-[.65rem] text-neon bg-neon/10 px-2 py-0.5 rounded-full font-syne font-bold uppercase">Active</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.toggle-ban', $user) }}" method="POST" class="inline">
                                @csrf
                                @if($user->is_banned)
                                    <button type="submit" class="text-[.65rem] text-neon/70 hover:text-neon border border-neon/10 hover:border-neon/25 px-3 py-1 rounded-lg transition-all uppercase font-bold">Unban</button>
                                @else
                                    <button type="submit" onclick="return confirm('Ban this user?')" class="text-[.65rem] text-red-400/70 hover:text-red-400 border border-red-500/10 hover:border-red-400/25 px-3 py-1 rounded-lg transition-all uppercase font-bold">Ban</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-white/20 text-xs italic">No users found matching your criteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </main>
</div>
@endsection