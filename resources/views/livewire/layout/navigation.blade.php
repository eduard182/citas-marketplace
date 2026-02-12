<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="h-16 flex items-center justify-between gap-4">

            {{-- LEFT: Logo + Desktop links --}}
            <div class="flex items-center gap-6 min-w-[180px]">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-xl bg-slate-900 text-white grid place-items-center font-bold">CM</div>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-900">CitasMarket</div>
                        <div class="text-[11px] text-slate-500 -mt-0.5">Reservas online</div>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-5 text-sm">
                    <a href="/proveedores" class="text-slate-600 hover:text-slate-900">Especialistas</a>
                    <a href="/mi-cuenta/citas" class="text-slate-600 hover:text-slate-900">Mis citas</a>
                </div>
            </div>

            {{-- CENTER: Search --}}
            

            {{-- RIGHT: CTA + User --}}
            <div class="flex items-center gap-2 min-w-[180px] justify-end">

                @auth
                    {{-- Role CTA --}}
                    @if(auth()->user()->role === 'provider')
                        <a href="/provider/agenda"
                           class="hidden md:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-300">
                            <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                            Mi agenda
                        </a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="/admin"
                           class="hidden md:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-300">
                            Panel admin
                        </a>
                    @else
                        <a href="/mi-cuenta/citas"
                           class="hidden md:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-300">
                            Mis citas
                        </a>
                    @endif

                    {{-- User dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2 hover:border-slate-300">
                                <div class="h-7 w-7 rounded-full bg-slate-100 grid place-items-center text-slate-700 text-xs font-semibold">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <div class="text-sm font-medium text-slate-900 leading-4">{{ auth()->user()->name }}</div>
                                    <div class="text-[11px] text-slate-500 -mt-0.5">
                                        {{ auth()->user()->role ?? 'user' }}
                                    </div>
                                </div>
                                <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">
                                Dashboard
                            </x-dropdown-link>

                            <x-dropdown-link href="/mi-cuenta/citas">
                                Mis citas
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <div class="border-t border-slate-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden md:inline-flex rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:border-slate-300">
                        Ingresar
                    </a>
                    <a href="{{ route('register') }}"
                       class="hidden md:inline-flex rounded-xl bg-slate-900 px-4 py-2 text-sm text-white hover:bg-slate-800">
                        Crear cuenta
                    </a>
                @endauth

                {{-- Mobile button --}}
                <button @click="open = !open" class="md:hidden inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2">
                    <svg class="h-6 w-6 text-slate-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak class="md:hidden pb-4">
            <div class="pt-2">
                <form action="/buscar" method="GET">
                    <div class="flex items-center rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <div class="pl-4 pr-2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-4.3-4.3m1.8-5.2a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" name="q" placeholder="Buscar…"
                               class="w-full border-0 bg-transparent py-3 text-sm focus:ring-0" />
                        <button class="m-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm text-white">Ir</button>
                    </div>
                </form>
            </div>

            <div class="mt-3 space-y-1 text-sm">
                <a href="/proveedores" class="block rounded-xl px-3 py-2 text-slate-700 hover:bg-slate-50">Especialistas</a>
                <a href="/mi-cuenta/citas" class="block rounded-xl px-3 py-2 text-slate-700 hover:bg-slate-50">Mis citas</a>

                @guest
                    <a href="{{ route('login') }}" class="block rounded-xl px-3 py-2 text-slate-700 hover:bg-slate-50">Ingresar</a>
                    <a href="{{ route('register') }}" class="block rounded-xl px-3 py-2 text-slate-700 hover:bg-slate-50">Crear cuenta</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
