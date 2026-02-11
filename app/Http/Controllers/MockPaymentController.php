<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class MockPaymentController extends Controller
{
    public function pay(Request $request, Booking $booking)
    {
        abort_unless(auth()->check(), 403);
        abort_unless($booking->client_id === auth()->id(), 403);

        $booking->load(['service']);

        Payment::updateOrCreate(
            ['booking_id' => $booking->id],
            [
                'amount_clp' => $booking->service->price_clp,
                'status' => 'paid',
                'provider' => 'mock',
                'provider_ref' => 'mock-' . now()->timestamp,

                // si tu tabla payments exige buy_order:
                'buy_order' => 'MOCK-' . $booking->id . '-' . now()->format('YmdHis'),
            ]
        );

       $token = Str::random(48);

$booking->update([
    'status' => 'confirmed',
    'lock_expires_at' => null,

    'meeting_provider' => 'mock',
    'meeting_id' => 'mock-' . $booking->id,
    'meeting_join_url' => url('/meet/' . $booking->id),
    'meeting_host_url' => url('/meet/' . $booking->id . '/host'),
]);


        return redirect()->to('/mi-cuenta/citas');
    }
}
