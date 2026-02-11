<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-slate-900">Mis citas</h1>

        <div class="mt-6 space-y-3">
            @forelse($bookings as $b)
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <div class="font-semibold text-slate-900">
                            {{ $b->provider->providerProfile?->display_name ?? $b->provider->name }}
                        </div>
                        <div class="text-sm text-slate-600">
                            {{ $b->service->name }} •
                            {{ $b->start_at->timezone('America/Santiago')->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="text-sm">
                        <span class="inline-flex items-center rounded-full border border-slate-200 px-3 py-1">
                            {{ $b->status }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm text-slate-600">
                    Aún no tienes citas.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
