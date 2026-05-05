<div id="addPitchModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm px-4">
    <div class="bg-card border border-neon/20 w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="px-6 py-5 border-b border-neon/10 flex justify-between items-center bg-surface/50">
            <h2 class="font-bebas text-2xl tracking-wide text-white">ADD NEW STADIUM</h2>
            <button onclick="toggleModal('addPitchModal')" class="text-white/30 hover:text-white transition-colors">✕</button>
        </div>

        <form action="{{ route('admin.addStad') }}" method="POST" class="p-6 grid grid-cols-2 gap-4">
            @csrf
            <div class="col-span-2">
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Stadium Name</label>
                <input type="text" name="name" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Manager</label>
                <select name="managerId" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    @foreach($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">City</label>
                <select name="city_id" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white/60 outline-none focus:border-neon/40">
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2">
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Address</label>
                <input type="text" name="address" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Capacity</label>
                <input type="number" name="capacity" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Price Per Hour (MAD)</label>
                <input type="number" step="0.01" name="price_per_hour" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Open From</label>
                <input type="time" name="open_from" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Open Until</label>
                <input type="time" name="open_until" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div class="col-span-2">
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Equipments</label>
                <textarea name="equipments" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40 h-20"></textarea>
            </div>

            <div class="col-span-2 flex gap-3 mt-4">
                <button type="button" onclick="toggleModal('addPitchModal')" class="flex-1 px-6 py-3 rounded-xl border border-white/10 text-white/40 font-syne font-bold text-xs hover:bg-white/5 transition-all">CANCEL</button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-neon text-ink font-syne font-bold text-xs hover:opacity-90 transition-all">SAVE STADIUM</button>
            </div>
        </form>
    </div>
</div>