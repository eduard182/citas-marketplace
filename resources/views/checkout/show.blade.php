<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold text-slate-900">Checkout</h1>
            <p class="text-slate-600 mt-1">Revisa tu reserva.</p>

            <div class="mt-6 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-600">Proveedor</span>
                    <span class="font-medium">
                        {{ $booking->provider->providerProfile?->display_name ?? $booking->provider->name }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-600">Servicio</span>
                    <span class="font-medium">{{ $booking->service->name }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-600">Duración</span>
                    <span class="font-medium">{{ $booking->service->duration_min }} min</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-600">Fecha y hora</span>
                    <span class="font-medium">
                        {{ $booking->start_at->timezone('America/Santiago')->format('d/m/Y H:i') }}
                    </span>
                </div>

                <div class="pt-3 border-t border-slate-200 flex justify-between text-base">
                    <span class="text-slate-900 font-semibold">Total</span>
                    <span class="text-slate-900 font-semibold">
                        ${{ number_format($booking->service->price_clp, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="/p/{{ $booking->provider->providerProfile->slug }}"
                   class="rounded-xl border border-slate-200 px-4 py-2 text-slate-700 hover:border-slate-400">
                    Volver
                </a>

                <form method="POST" action="/pay/mock/{{ $booking->id }}" class="flex-1">
                    @csrf
                    <button class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-white">
                        Pagar (simulado)
                    </button>
                </form>
            </div>

            <p class="mt-4 text-xs text-slate-500">
                * Luego reemplazamos este botón por Webpay cuando tengas credenciales.
            </p>
        </div>
    </div>
</x-app-layout>
