<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class MockPaymentController extends Controller
{
    public function pay(Request $request, Booking $booking)
    {
        abort_unless(auth()->check(), 403);
        abort_unless($booking->client_id === auth()->id(), 403);

        // si ya está pagada/confirmada, no repetir
        if ($booking->status === 'confirmed') {
            return redirect()->to('/mi-cuenta/citas');
        }

    Payment::updateOrCreate(
    ['booking_id' => $booking->id],
    [
        'amount_clp' => $booking->service->price_clp,
        'status' => 'paid',

        // ✅ campos que tu tabla exige (para Webpay después)
        'buy_order' => 'MOCK-' . $booking->id . '-' . now()->format('YmdHis'),
        'session_id' => (string) auth()->id(),

        // ✅ los que agregamos
        'provider' => 'mock',
        'provider_ref' => 'mock-' . now()->timestamp,
    ]
);


        $booking->update([
            'status' => 'confirmed',
            'lock_expires_at' => null,
        ]);

        return redirect()->to('/mi-cuenta/citas');
    }
}
