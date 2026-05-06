<!DOCTYPE html>
<html>
<body>
    <h2>Your Reservation has been Canceled ❌</h2>

    <p>Hello {{ $reservation->user->fullname }},</p>

    <p>Your reservation at <strong>{{ $reservation->stadium->name }}</strong> has been canceled.</p>

    <ul>
        <li><strong>Date:</strong> {{ $reservation->reservation_date->format('d/m/Y') }}</li>
        <li><strong>Time:</strong> {{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}</li>
    </ul>

    <p>Please contact us if you have any questions.</p>
</body>
</html>