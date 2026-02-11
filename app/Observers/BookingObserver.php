<?php

namespace App\Observers;

use App\Models\Booking;

class BookingObserver
{
    public function updated(Booking $booking): void
    {
        // Solo cuando pasa a confirmed
        if ($booking->wasChanged('status') && $booking->status === 'confirmed') {

            // Si ya tiene link, no hacer nada
            if (!empty($booking->meeting_join_url)) {
                return;
            }

            $booking->meeting_provider = 'mock';
            $booking->meeting_id = 'mock-' . $booking->id;
            $booking->meeting_join_url = url('/meet/' . $booking->id);
            $booking->meeting_host_url = url('/meet/' . $booking->id . '/host');

            // Guardar sin disparar loop
            $booking->saveQuietly();
        }
    }
}
