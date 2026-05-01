<!-- MODAL OVERLAY -->
<div id="profileModal" class="hidden fixed inset-0 z-[999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    
    <!-- MODAL BOX -->
    <div class="bg-card border border-neon/20 w-full max-w-md rounded-2xl p-8 shadow-2xl">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bebas text-2xl text-white tracking-wide">Edit Profile</h2>
            <!-- Close Button -->
            <button onclick="closeModal()" class="text-white/30 hover:text-white text-xl">✕</button>
        </div>

        <form action="" method="POST">
            @csrf
            @method('PATCH')
            <div class="space-y-5">
                <div>
                    <label class="block text-[0.65rem] uppercase tracking-widest text-white/40 mb-2 font-bold">Email Address</label>
                    <input type="email" name="email" value="{{ $user->email }}" required
                           class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-neon/40 transition-all">
                </div>
                <div>
                    <label class="block text-[0.65rem] uppercase tracking-widest text-white/40 mb-2 font-bold">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ $user->phone_number }}" required
                           class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-neon/40 transition-all">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 px-6 py-3 rounded-xl border border-neon/10 text-white/50 font-syne font-bold text-xs">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 rounded-xl bg-neon text-ink font-syne font-bold text-xs hover:opacity-90 transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
