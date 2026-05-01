let activeStadiumId = null;

function openModifyModal(actionUrl, stadiumId, currentDate, currentTime, price) {
    activeStadiumId = stadiumId;
    
    const modal = document.getElementById('modifyModal');
    const form = document.getElementById('modifyForm');
    const dateInput = document.getElementById('modalDate');
    
    // Fill data
    form.action = actionUrl;
    dateInput.value = currentDate;
    document.getElementById('modalPriceDisplay').innerText = price + ' MAD';
    document.getElementById('selectedTimeLabel').innerText = currentTime;
    document.getElementById('selectedTime').value = currentTime;

    // Load slots
    fetchModalSlots(stadiumId, currentDate);

    modal.classList.remove('hidden');
}

function closeModifyModal() {
    document.getElementById('modifyModal').classList.add('hidden');
}

function fetchModalSlots(stadiumId, date) {
    const grid = document.getElementById('modalSlotsGrid');
    grid.innerHTML = '<div class="col-span-4 py-10 text-center text-white/20 text-xs">Loading...</div>';

    fetch(`/pitches/${stadiumId}/slots?date=${date}`)
        .then(res => res.json())
        .then(slots => {
            grid.innerHTML = '';
            slots.forEach(slot => {
                if (slot.booked) {
                    grid.innerHTML += `
                        <div class="flex flex-col items-center justify-center rounded-xl py-5 bg-red-950/10 border border-red-900/20 cursor-not-allowed opacity-40">
                            <span class="text-white/40 font-bold text-sm">${slot.time}</span>
                            <span class="text-red-500 text-[0.6rem] mt-1 font-bold">BUSY</span>
                        </div>`;
                } else {
                    grid.innerHTML += `
                        <div onclick="selectModalSlot('${slot.time}')" 
                             id="m-slot-${slot.time.replace(':', '-')}"
                             class="modal-slot-card flex flex-col items-center justify-center rounded-xl py-5 bg-white/5 border border-white/10 hover:border-neon/50 cursor-pointer transition-all">
                            <span class="text-white font-bold text-sm">${slot.time}</span>
                            <span class="text-neon/50 text-[0.6rem] mt-1">AVAILABLE</span>
                        </div>`;
                }
            });
        });
}

function selectModalSlot(time) {
    document.querySelectorAll('.modal-slot-card').forEach(el => {
        el.classList.remove('border-neon', 'bg-neon/10');
        el.classList.add('border-white/10', 'bg-white/5');
    });

    const selected = document.getElementById('m-slot-' + time.replace(':', '-'));
    selected.classList.add('border-neon', 'bg-neon/10');
    selected.classList.remove('border-white/10', 'bg-white/5');

    document.getElementById('selectedTime').value = time;
    document.getElementById('selectedTimeLabel').innerText = time;
}

// Handle date changes
document.getElementById('modalDate').addEventListener('change', function() {
    if(activeStadiumId) fetchModalSlots(activeStadiumId, this.value);
});
