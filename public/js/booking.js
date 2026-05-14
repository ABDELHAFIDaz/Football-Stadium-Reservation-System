const datePicker = document.getElementById('datePicker');
const slotsGrid  = document.getElementById('slotsGrid');
const slotsRoute = document.getElementById('slotsRoute').value;

function loadSlots(date) {
    fetch(`${slotsRoute}?date=${date}`)
        .then(res => res.json())
        .then(slots => {
            slotsGrid.innerHTML = '';

            slots.forEach(slot => {
                if (slot.booked) {
                    slotsGrid.innerHTML += `
                        <div class="flex flex-col items-center justify-center rounded-xl py-5 bg-red-950 border border-red-900 cursor-not-allowed">
                            <span class="text-white/40 font-semibold text-base">${slot.time}</span>
                            <span class="text-red-500 text-xs mt-1">-</span>
                        </div>`;
                } else {
                    slotsGrid.innerHTML += `
                        <div onclick="selectSlot('${slot.time}')"
                             id="slot-${slot.time.replace(':', '-')}"
                             class="slot-card flex flex-col items-center justify-center rounded-xl py-5 bg-green-950 border border-green-800 hover:border-green-400 hover:bg-green-900 transition-all cursor-pointer">
                            <span class="text-white font-semibold text-base">${slot.time}</span>
                            <span class="text-white/50 text-xs mt-1">1h</span>
                        </div>`;
                }
            });
        });
}

function selectSlot(time) {
    document.querySelectorAll('.slot-card').forEach(el => {
        el.classList.remove('border-green-400', 'bg-green-900');
        el.classList.add('border-green-800', 'bg-green-950');
    });

    const selected = document.getElementById('slot-' + time.replace(':', '-'));
    selected.classList.add('border-green-400', 'bg-green-900');

    document.getElementById('selectedTime').value = time;
    document.getElementById('selectedDate').value = datePicker.value;
    document.getElementById('selectedLabel').textContent = time;
}

datePicker.addEventListener('change', function () {
    loadSlots(this.value);
});

loadSlots(datePicker.value);