<div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    <h3 class="text-lg font-semibold text-slate-900">Reservar</h3>
    <p class="text-sm text-slate-600 mb-4">Elige servicio, fecha y hora.</p>

    <div class="space-y-3">
        <div>
            <label class="text-sm font-medium text-slate-700">Servicio</label>
            <select wire:model.live="serviceId" class="mt-1 w-full rounded-xl border-slate-200">
                <option value="">Selecciona...</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}">
                        {{ $s->name }} — {{ $s->duration_min }} min — ${{ number_format($s->price_clp, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('serviceId') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-sm font-medium text-slate-700">Fecha</label>
            <input type="date" wire:model.live="date" class="mt-1 w-full rounded-xl border-slate-200">
            @error('date') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
        </div>

        @if($serviceId)
            <div>
                <label class="text-sm font-medium text-slate-700">Horas disponibles</label>

                @if(empty($slots))
                    <div class="mt-2 text-sm text-slate-600">No hay horas disponibles para esta fecha.</div>
                @else
                    <div class="mt-2 grid grid-cols-3 gap-2 sm:grid-cols-4">
                        @foreach($slots as $slot)
                            <button type="button"
                                wire:click="$set('time','{{ $slot }}')"
                                class="rounded-xl border px-2 py-2 text-sm
                                {{ $time === $slot ? 'border-slate-900 text-slate-900' : 'border-slate-200 text-slate-700 hover:border-slate-400' }}">
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                    @error('time') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                @endif
            </div>
        @endif

        <button
            wire:click="reserve"
            class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-white disabled:opacity-50"
            @disabled(!$serviceId || !$date || !$time)
        >
            Confirmar y pagar
        </button>
    </div>
</div>
