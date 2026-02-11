<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h1 class="text-2xl font-bold text-slate-900">{{ $provider->providerProfile?->display_name ?? $provider->name }}</h1>
                <p class="text-slate-600 mt-1">{{ $provider->providerProfile?->city }}</p>
            </div>
        </div>

        <div>
            @auth
                <livewire:provider-booking-widget :provider="$provider" />
            @else
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-slate-700">Inicia sesión para reservar.</p>
                    <a href="/login" class="inline-block mt-3 rounded-xl bg-slate-900 text-white px-4 py-2">Ingresar</a>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
