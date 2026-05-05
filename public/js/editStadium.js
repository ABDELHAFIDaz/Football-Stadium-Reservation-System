function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }

    function openEditModal(pitch) {
        const form = document.getElementById('editPitchForm');
        form.action = `/editStad/${pitch.id}`;

        // Fill basic fields
        document.getElementById('edit_name').value = pitch.name;
        document.getElementById('edit_price').value = pitch.price_per_hour;
        document.getElementById('edit_status').value = pitch.status;
        document.getElementById('edit_open_from').value = pitch.open_from;
        document.getElementById('edit_open_until').value = pitch.open_until;
        document.getElementById('edit_note').value = pitch.note;
        document.getElementById('edit_open_until').value = pitch.open_until;

        toggleModal('editPitchModal');
        toggleUnavailableInputs(pitch.status);
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