<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold text-slate-900">Reunión (Demo)</h1>
            <p class="text-slate-600 mt-2">
                Aquí luego abrimos Zoom o Google Meet real. Por ahora es mock.
            </p>

            <div class="mt-6 space-y-2 text-sm">
                <div><b>Proveedor:</b> {{ $booking->provider->providerProfile?->display_name ?? $booking->provider->name }}</div>
                <div><b>Fecha:</b> {{ $booking->start_at->timezone('America/Santiago')->format('d/m/Y H:i') }}</div>
                <div><b>Meeting ID:</b> {{ $booking->meeting_id }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
