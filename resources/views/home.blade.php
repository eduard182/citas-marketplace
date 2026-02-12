<x-app-layout>
    {{-- HERO con background --}}
    <section class="relative min-h-[520px] md:min-h-[600px] overflow-hidden">
        {{-- Background image --}}
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=2400&q=80"
                alt="Background"
                class="h-full w-full object-cover"
            />
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-slate-900/55"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/65"></div>
        </div>

        <div class="relative">
            <div class="max-w-7xl mx-auto px-4 pt-14 md:pt-20 pb-14">
                <div class="text-center">
                    <h1 class="text-white text-4xl md:text-6xl font-bold tracking-tight">
                        Encuentra tu cita online
                    </h1>
                    <p class="mt-4 text-white/80 text-base md:text-lg">
                        Reserva con especialistas verificados. Elige fecha y hora. Paga y entra a tu reunión.
                    </p>
                </div>

                {{-- Search bar grande (estilo ejemplo) --}}
<form action="/buscar" method="GET" class="mt-10">
    <div class="mx-auto max-w-6xl">
        <div class="rounded-[34px] bg-white/95 backdrop-blur border border-white/40 shadow-2xl px-3 py-3">

            <div class="flex flex-col md:flex-row md:items-center">

                {{-- 1) Buscar --}}
                <div class="flex items-center gap-3 px-5 py-4 md:flex-1">
                    <span class="text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </span>

                    <input
                        name="q"
                        placeholder="Buscar servicio o especialista..."
                        class="w-full border-0 bg-transparent text-base text-slate-900 placeholder:text-slate-400 focus:ring-0"
                    />
                </div>

                {{-- Divider --}}
                <div class="hidden md:block w-px h-10 bg-slate-200"></div>

                {{-- 2) Ubicación --}}
                <div class="flex items-center gap-3 px-5 py-4 md:w-[260px]">
                    <span class="text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 21s7-4.35 7-11a7 7 0 1 0-14 0c0 6.65 7 11 7 11Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        </svg>
                    </span>

                    <select name="city" class="w-full border-0 bg-transparent text-base text-slate-700 focus:ring-0">
                        <option value="">Ubicación</option>
                        <option value="santiago">Santiago</option>
                        <option value="valparaiso">Valparaíso</option>
                        <option value="concepcion">Concepción</option>
                    </select>
                </div>

                {{-- Divider --}}
                <div class="hidden md:block w-px h-10 bg-slate-200"></div>

                {{-- 3) Categorías --}}
                <div class="flex items-center gap-3 px-5 py-4 md:w-[320px]">
                    <span class="text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </span>

                    <select name="category" class="w-full border-0 bg-transparent text-base text-slate-700 focus:ring-0">
                        <option value="">Todas las categorías</option>
                        <option value="psicologia">Psicología</option>
                        <option value="nutricion">Nutrición</option>
                        <option value="coaching">Coaching</option>
                    </select>
                </div>

                {{-- Botón a la derecha --}}
                <div class="px-3 pb-3 md:pb-0 md:px-3 md:py-3">
                    <button
                        class="w-full md:w-auto rounded-full bg-rose-500 hover:bg-rose-600 px-10 py-4 text-white font-semibold shadow-lg">
                        Buscar
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>




                {{-- Chips --}}
                <div class="mt-8 flex flex-wrap justify-center gap-2 text-sm">
                    @foreach(['Psicología','Nutrición','Coaching','Salud general','Terapia de pareja'] as $chip)
                        <a href="/buscar?q={{ urlencode($chip) }}"
                           class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-white/90 hover:bg-white/25 border border-white/15">
                            {{ $chip }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- LISTA DE PROVEEDORES --}}
    <section class="bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 py-14">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Proveedores destacados</h2>
                    <p class="mt-1 text-slate-600">Reserva en minutos. Reuniones online.</p>
                </div>
                <a href="/proveedores" class="text-sm text-slate-700 underline">Ver todos</a>
            </div>

            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                {{-- Cards MOCK (luego lo conectamos a DB) --}}
                @foreach([
                  ['Psicóloga Online','Santiago','Desde $20.000','Disponible hoy'],
                  ['Nutricionista','Valparaíso','Desde $18.000','Agenda semanal'],
                  ['Coach','Santiago','Desde $25.000','Top reseñas'],
                  ['Médico General','Concepción','Desde $15.000','Atención rápida'],
                  ['Terapia de Pareja','Santiago','Desde $28.000','Sesión 60 min'],
                  ['Dermatología','Santiago','Desde $30.000','Online'],
                ] as $p)
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm hover:border-slate-300">
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-900">{{ $p[0] }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ $p[1] }} • Online</div>
                                </div>
                                <span class="text-xs rounded-full border border-slate-200 px-2 py-1 text-slate-600">
                                    {{ $p[3] }}
                                </span>
                            </div>

                            <div class="mt-4 text-sm text-slate-700">{{ $p[2] }}</div>

                            <div class="mt-5 flex items-center justify-between">
                                <div class="text-xs text-slate-500">★ 4.8 • 120 reseñas</div>
                                <a href="/p/proveedor-demo"
                                   class="rounded-xl bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-800">
                                    Ver perfil
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CATEGORÍAS --}}
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-14">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Categorías</h2>
                    <p class="mt-1 text-slate-600">Explora especialistas por tipo de servicio.</p>
                </div>
                <a href="/buscar" class="text-sm text-slate-700 underline">Explorar</a>
            </div>

            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach([
                    ['Psicología','Sesiones online'],
                    ['Nutrición','Planes y seguimiento'],
                    ['Coaching','Objetivos y hábitos'],
                    ['Salud general','Consulta rápida'],
                    ['Terapia de pareja','Sesiones 60 min'],
                    ['Dermatología','Online'],
                    ['Psiquiatría','Atención especializada'],
                    ['Fonoaudiología','Evaluación y terapia'],
                ] as $c)
                    <a href="/buscar?q={{ urlencode($c[0]) }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
                        <div class="text-sm font-semibold text-slate-900 group-hover:underline">{{ $c[0] }}</div>
                        <div class="mt-1 text-xs text-slate-500">{{ $c[1] }}</div>
                        <div class="mt-4 text-xs text-slate-600">Ver →</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FOOTER PRO --}}
    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="font-semibold text-slate-900">CitasMarket</div>
                    <p class="mt-2 text-sm text-slate-600">
                        Plataforma de reservas online y reuniones.
                    </p>
                </div>

                <div>
                    <div class="text-sm font-semibold text-slate-900">Plataforma</div>
                    <div class="mt-3 space-y-2 text-sm">
                        <a href="/proveedores" class="block text-slate-600 hover:text-slate-900">Especialistas</a>
                        <a href="/mi-cuenta/citas" class="block text-slate-600 hover:text-slate-900">Mis citas</a>
                        <a href="/publicar" class="block text-slate-600 hover:text-slate-900">Publicar agenda</a>
                    </div>
                </div>

                <div>
                    <div class="text-sm font-semibold text-slate-900">Soporte</div>
                    <div class="mt-3 space-y-2 text-sm">
                        <a href="/ayuda" class="block text-slate-600 hover:text-slate-900">Centro de ayuda</a>
                        <a href="/terminos" class="block text-slate-600 hover:text-slate-900">Términos</a>
                        <a href="/privacidad" class="block text-slate-600 hover:text-slate-900">Privacidad</a>
                    </div>
                </div>

                <div>
                    <div class="text-sm font-semibold text-slate-900">Contacto</div>
                    <div class="mt-3 space-y-2 text-sm text-slate-600">
                        <div>Chile</div>
                        <div>soporte@citasmarket.test</div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                <div>© {{ date('Y') }} CitasMarket. Todos los derechos reservados.</div>
                <div class="flex gap-4">
                    <a class="hover:text-slate-900" href="/terminos">Términos</a>
                    <a class="hover:text-slate-900" href="/privacidad">Privacidad</a>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>
