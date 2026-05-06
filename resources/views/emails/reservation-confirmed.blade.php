<!DOCTYPE html>
<html>
<body>
    <h2>Your Reservation has been Confirmed ✅</h2>

    <p>Hello {{ $reservation->user->fullname }},</p>

    <p>Your reservation at <strong>{{ $reservation->stadium->name }}</strong> has been confirmed.</p>

    <ul>
        <li><strong>Date:</strong> {{ $reservation->reservation_date->format('d/m/Y') }}</li>
        <li><strong>Time:</strong> {{ $reservation->start_time->format('H:i') }} - {{ $reservation->end_time->format('H:i') }}</li>
        <li><strong>Total Price:</strong> {{ $reservation->total_price }} DH</li>
    </ul>

    <p>Thank you for using our platform!</p>
</body>
</html>