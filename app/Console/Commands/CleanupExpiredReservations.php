<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class CleanupExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        // 1. Confirmed -> Ended (If date + end_time is in the past)
        Reservation::where('status', 'confirmed')
            ->whereRaw("CONCAT(reservation_date, ' ', end_time) < ?", [$now])
            ->update(['status' => 'ended']);

        // 2. Pending -> Canceled (If date + start_time is in the past)
        Reservation::where('status', 'pending')
            ->whereRaw("CONCAT(reservation_date, ' ', start_time) < ?", [$now])
            ->update(['status' => 'canceled']);
    }
}
