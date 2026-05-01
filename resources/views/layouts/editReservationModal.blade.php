<div id="modifyModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-md p-4">
    <div class="bg-[#0A0A0A] border border-white/5 w-full max-w-4xl rounded-3xl overflow-hidden flex shadow-2xl">

        <!-- LEFT: SELECTION -->
        <div class="flex-1 p-8 border-r border-white/5 max-h-[80vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-8"> {{-- Added justify-between --}}
                <div class="flex items-center gap-4">
                    <span class="bg-[#1A1A1A] text-white px-6 py-2 rounded-xl text-xs font-bold border border-white/5">Modify Slot</span>

                    {{-- Manager Phone Number Display --}}
                    <div class="flex items-center gap-2 px-4 py-2 border border-white/5 rounded-xl bg-white/5">
                        <span class="text-[0.6rem] text-white/30 uppercase tracking-widest font-bold">Manager:</span>
                        <span id="modalManagerPhone" class="text-xs text-neon font-bold">Loading...</span>
                    </div>
                </div>
            </div>

            <form id="modifyForm" method="POST" action="{{ route('reservation.update', $reservationId) }}">
                @csrf
                @method('PATCH')

                <div class="mb-8">
                    <label class="block text-xs font-bold text-white/50 mb-3 uppercase tracking-widest">Select a Date</label>
                    <input type="date" name="date" id="modalDate" required
                        class="bg-[#111] border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-neon/40 w-56">
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-white/50 uppercase tracking-widest">Available Time Slots</label>
                </div>

                <div id="modalSlotsGrid" class="grid grid-cols-4 gap-3">
                    <!-- JS Injected Here -->
                </div>

                <input type="hidden" name="start_time" id="selectedTime">
        </div>

        <!-- RIGHT: SUMMARY -->
        <div class="w-80 bg-[#0D0D0D] p-8 flex flex-col justify-between">
            <div>
                <h3 class="font-syne font-bold text-white mb-6">Update Reservation</h3>
                <div class="mb-8">
                    <div class="text-[0.6rem] uppercase tracking-widest text-white/30 mb-1">Price per Hour</div>
                    <div id="modalPriceDisplay" class="text-2xl font-bold text-neon">0 MAD</div>
                </div>
                <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                    <div class="text-[0.6rem] text-white/30 uppercase mb-1">New Time</div>
                    <div id="selectedTimeLabel" class="text-neon font-bold text-lg">--:--</div>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <button type="submit" class="w-full bg-neon text-ink font-syne font-bold py-4 rounded-2xl hover:brightness-110 transition-all shadow-[0_0_20px_rgba(61,255,122,0.2)]">
                    CONFIRM UPDATE →
                </button>
                <button type="button" onclick="closeModifyModal()" class="w-full py-4 text-white/30 text-xs font-bold hover:text-white transition-all text-center">
                    CLOSE
                </button>
            </div>
        </div>
        </form>
    </div>
</div>