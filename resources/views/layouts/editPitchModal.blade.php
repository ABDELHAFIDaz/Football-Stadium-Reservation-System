<div id="editPitchModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm px-4">
    <div class="bg-card border border-neon/20 w-full max-w-2xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="px-6 py-5 border-b border-neon/10 flex justify-between items-center bg-surface/50">
            <h2 class="font-bebas text-2xl tracking-wide text-white">EDIT STADIUM</h2>
            <button onclick="toggleModal('editPitchModal')" class="text-white/30 hover:text-white transition-colors">✕</button>
        </div>

        <form id="editPitchForm" method="POST" class="p-6 grid grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            <div class="col-span-2">
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Stadium Name</label>
                <input type="text" name="name" id="edit_name" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold tracking-widest mb-2 block">Status</label>
                <select name="status" id="edit_status" onchange="toggleUnavailableInputs(this.value)" required
                    class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2.5 text-sm text-white/70 outline-none focus:border-neon/40 appearance-none">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Price Per Hour (MAD)</label>
                <input type="number" step="0.01" name="price_per_hour" id="edit_price" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Open From</label>
                <input type="time" name="open_from" id="edit_open_from" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div>
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Open Until</label>
                <input type="time" name="open_until" id="edit_open_until" required class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40">
            </div>

            <div class="col-span-2">
                <label class="text-[.65rem] text-white/40 uppercase font-bold mb-1 block">Note</label>
                <textarea name="note" id="edit_note" rows="2" class="w-full bg-surface border border-neon/10 rounded-xl px-4 py-2 text-sm text-white outline-none focus:border-neon/40 resize-none"></textarea>
            </div>

            <div id="unavailable_dates_container" class="hidden col-span-2 grid grid-cols-2 gap-4 animate-fade-in bg-neon/5 p-4 rounded-xl border border-neon/10">
                <div>
                    <label class="text-[.65rem] text-neon uppercase font-bold tracking-widest mb-2 block">Unavailable From</label>
                    <input type="date" name="unavailable_from" id="edit_unavailable_from"
                        class="w-full bg-[#070b09] border border-neon/20 rounded-xl px-4 py-2 text-sm text-white outline-none">
                </div>
                <div>
                    <label class="text-[.65rem] text-neon uppercase font-bold tracking-widest mb-2 block">Unavailable Until</label>
                    <input type="date" name="unavailable_until" id="edit_unavailable_until"
                        class="w-full bg-[#070b09] border border-neon/20 rounded-xl px-4 py-2 text-sm text-white outline-none">
                </div>
            </div>

            <div class="col-span-2 flex gap-3 mt-4">
                <button type="button" onclick="toggleModal('editPitchModal')" class="flex-1 px-6 py-3 rounded-xl border border-white/10 text-white/40 font-syne font-bold text-xs hover:bg-white/5 transition-all">CANCEL</button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-neon text-ink font-syne font-bold text-xs hover:opacity-90 transition-all shadow-[0_0_15px_rgba(61,255,122,0.2)]">UPDATE STADIUM</button>
            </div>
        </form>
    </div>
</div>