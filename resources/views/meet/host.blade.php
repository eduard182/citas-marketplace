<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold text-slate-900">Host (Demo)</h1>
            <p class="text-slate-600 mt-2">
                Solo el proveedor puede ver esta página.
            </p>

            <div class="mt-6 text-sm">
                <div><b>Meeting ID:</b> {{ $booking->meeting_id }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
