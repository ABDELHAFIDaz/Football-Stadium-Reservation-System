<!-- ADD MANAGER MODAL -->
<div id="addManagerModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm px-4">
    <div class="bg-card border border-neon/20 w-full max-w-md rounded-2xl overflow-hidden shadow-2xl">
        <div class="px-6 py-5 border-b border-neon/10 flex justify-between items-center bg-surface/50">
            <h2 class="font-bebas text-2xl tracking-wide text-white">CREATE MANAGER ACCOUNT</h2>
            <button onclick="document.getElementById('addManagerModal').classList.add('hidden')" class="text-white/30 hover:text-white transition-colors">✕</button>
        </div>

        <form action="{{ route('admin.users.storeManager') }}" method="POST" class="p-6 flex flex-col gap-4">
            @csrf
            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold tracking-widest mb-2 block">Full Name</label>
                <input type="text" name="fullname" required placeholder="e.g. Ahmed Hassani"
                    class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-neon/40 transition-all">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold tracking-widest mb-2 block">Email Address</label>
                <input type="email" name="email" required placeholder="manager@stadium.com"
                    class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-neon/40 transition-all">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold tracking-widest mb-2 block">Phone Number</label>
                <input type="text" name="phone_number" placeholder="+212 6..."
                    class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-neon/40 transition-all">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold tracking-widest mb-2 block">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2.5 text-sm text-white outline-none focus:border-neon/40 transition-all">
            </div>

            <div class="flex gap-3 mt-4">
                <button type="button" onclick="document.getElementById('addManagerModal').classList.add('hidden')"
                    class="flex-1 px-6 py-3 rounded-xl border border-white/10 text-white/40 font-syne font-bold text-xs hover:bg-white/5 transition-all">
                    CANCEL
                </button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-neon text-ink font-syne font-bold text-xs hover:opacity-90 transition-all">
                    CREATE ACCOUNT
                </button>
            </div>
        </form>
    </div>
</div>