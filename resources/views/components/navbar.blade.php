<nav class="bg-white/95 backdrop-blur-md shadow-lg border-b border-gray-100 fixed w-full z-50 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center group">
                    <span class="text-2xl font-bold bg-gradient-to-r from-green-700 to-emerald-700 bg-clip-text text-transparent">
                        GulaHub
                    </span>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                {{-- USER BELUM LOGIN --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-2.5 rounded-xl font-medium">
                        Masuk
                    </a>
                @endguest

                @auth
                    <!-- Menu utama -->
                    <div class="hidden md:flex items-center space-x-6">
                        @if(Auth::user()->role === 'petani')
                            <a href="{{ route('petani.dashboard') }}"
                               class="{{ request()->routeIs('petani.dashboard') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('petani.jadwalgiling') }}"
                               class="{{ request()->routeIs('petani.jadwalgiling') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Jadwal Giling
                            </a>
                            <a href="{{ route('petani.rencanapanen') }}"
                               class="{{ request()->routeIs('petani.rencanapanen') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Rencana Panen
                            </a>
                            <a href="{{ route('petani.permintaan') }}"
                               class="{{ request()->routeIs('petani.permintaan') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Permintaan
                            </a>
                            <a href="{{ route('petani.ajuan') }}"
                               class="{{ request()->routeIs('petani.ajuan') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Pengajuan
                            </a>
                        @elseif(Auth::user()->role === 'pabrik')
                            <a href="{{ route('pabrik.dashboard') }}"
                               class="{{ request()->routeIs('pabrik.dashboard') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('pabrik.jadwalpanen') }}"
                               class="{{ request()->routeIs('pabrik.jadwalpanen') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Jadwal Panen
                            </a>
                            <a href="{{ route('pabrik.rencanagiling') }}"
                               class="{{ request()->routeIs('pabrik.rencanagiling') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Rencana Giling
                            </a>
                            <a href="{{ route('pabrik.permintaan') }}"
                               class="{{ request()->routeIs('pabrik.permintaan') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Permintaan
                            </a>
                            <a href="{{ route('pabrik.ajuan') }}"
                               class="{{ request()->routeIs('pabrik.ajuan') ? 'relative text-green-700 font-semibold px-3 py-2 rounded-lg transition-all duration-300 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-gradient-to-r after:from-green-600 after:to-emerald-600 after:rounded-full' : 'text-gray-600 hover:text-green-700 font-medium px-3 py-2 rounded-lg hover:bg-green-50 transition-all duration-300' }}">
                                Pengajuan
                            </a>
                        @endif
                    </div>

                    <!-- Dropdown profil -->
                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-green-700 focus:outline-none bg-gray-50 hover:bg-green-50 px-3 py-2 rounded-xl transition-all duration-300 group">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-600 to-emerald-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="hidden md:inline font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95 translate-y-1"
                             x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 scale-95 translate-y-1"
                             class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                            </div>

                            @if(Auth::user()->role === 'petani')
                                <a href="{{ route('petani.riwayatsetor') }}"
                                   class="flex items-center px-4 py-3 text-sm {{ request()->routeIs('petani.riwayatsetor') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }} transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Riwayat Permintaan
                                </a>
                                <a href="{{ route('petani.profil') }}"
                                   class="flex items-center px-4 py-3 text-sm {{ request()->routeIs('petani.profil') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }} transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profil
                                </a>
                            @elseif(Auth::user()->role === 'pabrik')
                                <a href="{{ route('pabrik.riwayatterima') }}"
                                   class="flex items-center px-4 py-3 text-sm {{ request()->routeIs('pabrik.riwayatterima') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }} transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Riwayat Permintaan
                                </a>
                                <a href="{{ route('pabrik.profil') }}"
                                   class="flex items-center px-4 py-3 text-sm {{ request()->routeIs('pabrik.profil') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-green-50 hover:text-green-700' }} transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profil
                                </a>
                            @endif

                            <div class="border-t border-gray-100 mt-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
