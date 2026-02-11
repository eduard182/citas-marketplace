<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProviderBookingWidget extends Component
{
    public User $provider;

    public ?int $serviceId = null;
    public string $date; // YYYY-MM-DD
    public ?string $time = null; // HH:MM

    public array $slots = [];

    public function mount(User $provider): void
    {
        $this->provider = $provider;
        $this->date = now('America/Santiago')->toDateString();
        $this->loadSlots();
    }

    public function updatedServiceId(): void
    {
        $this->time = null;
        $this->loadSlots();
    }

    public function updatedDate(): void
    {
        $this->time = null;
        $this->loadSlots();
    }

    public function loadSlots(): void
    {
        $this->slots = [];

        if (!$this->serviceId) {
            return;
        }

        $service = Service::where('provider_id', $this->provider->id)
            ->where('active', true)
            ->find($this->serviceId);

        if (!$service) return;

        $tz = 'America/Santiago';
        $day = Carbon::parse($this->date, $tz);
        $weekdayIso = (int) $day->isoWeekday(); // 1..7

        $rule = $this->provider->availabilityRules()
            ->where('weekday', $weekdayIso)
            ->where('active', true)
            ->first();

        if (!$rule) return;

        $step = (int) $rule->slot_step_min; // 30
        $duration = (int) $service->duration_min;

        $start = Carbon::parse($this->date.' '.$rule->start_time, $tz);
        $end = Carbon::parse($this->date.' '.$rule->end_time, $tz);

        // traer reservas que bloqueen ese día (confirmadas o pendientes y no expiradas)
        $bookings = Booking::where('provider_id', $this->provider->id)
            ->whereDate('start_at', $this->date)
            ->whereIn('status', ['confirmed','pending_payment'])
            ->get();

        for ($t = $start->copy(); $t->copy()->addMinutes($duration)->lte($end); $t->addMinutes($step)) {
            $slotStart = $t->copy();
            $slotEnd = $t->copy()->addMinutes($duration);

            $overlap = $bookings->first(function ($b) use ($slotStart, $slotEnd) {
                // si está pending_payment pero lock expiró, no bloquea
                if ($b->status === 'pending_payment' && $b->lock_expires_at && now()->gt($b->lock_expires_at)) {
                    return false;
                }
                return $slotStart->lt($b->end_at) && $slotEnd->gt($b->start_at);
            });

            if (!$overlap) {
                $this->slots[] = $slotStart->format('H:i');
            }
        }
    }

    public function reserve(): void
{
    $this->validate([
        'serviceId' => ['required','integer'],
        'date' => ['required','date_format:Y-m-d'],
        'time' => ['required'],
    ]);

    $service = \App\Models\Service::where('provider_id', $this->provider->id)
        ->where('active', true)
        ->findOrFail($this->serviceId);

    $tz = 'America/Santiago';
    $startAt = \Carbon\Carbon::parse($this->date.' '.$this->time, $tz);
    $endAt = $startAt->copy()->addMinutes((int)$service->duration_min);

    $conflict = \App\Models\Booking::where('provider_id', $this->provider->id)
        ->whereIn('status', ['confirmed','pending_payment'])
        ->where(function ($q) use ($startAt, $endAt) {
            $q->where('start_at', '<', $endAt)
              ->where('end_at', '>', $startAt);
        })
        ->get()
        ->first(function ($b) {
            return !($b->status === 'pending_payment' && $b->lock_expires_at && now()->gt($b->lock_expires_at));
        });

    if ($conflict) {
        $this->addError('time', 'Ese horario ya fue tomado. Elige otro.');
        $this->loadSlots();
        return; // ✅ esto sí está permitido (no devuelve valor)
    }

    $booking = \App\Models\Booking::create([
        'client_id' => auth()->id(),
        'provider_id' => $this->provider->id,
        'service_id' => $service->id,
        'start_at' => $startAt,
        'end_at' => $endAt,
        'status' => 'pending_payment',
        'lock_expires_at' => now()->addMinutes(15),
    ]);

    // ✅ Livewire redirect correcto:
    $this->redirect('/checkout/'.$booking->id);
}

public function render()
{
    $services = \App\Models\Service::where('provider_id', $this->provider->id)
        ->where('active', true)
        ->orderBy('name')
        ->get();

    return view('livewire.provider-booking-widget', [
        'services' => $services,
    ]);
}



}
