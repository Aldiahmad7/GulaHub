<div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-screen shadow-lg border-r border-gray-100 z-50">
    <div class="px-6 py-5 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div>
                <h1 class="text-2xl font-bold text-green-700">GulaHub</h1>
                <p class="text-xs text-gray-500 mt-0.5">Admin</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 overflow-y-auto">
        <ul class="space-y-1.5">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                          {{ request()->routeIs('admin.dashboard')
                              ? 'bg-green-50 text-green-700 font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="flex items-center justify-center w-6 mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </span>
                    Dashboard
                    <span class="ml-auto">
                        <svg class="w-4 h-4 text-green-500 opacity-0 group-hover:opacity-100" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </span>
                </a>
            </li>

            <li class="px-3">
                <div class="border-t border-gray-200"></div>
            </li>

            <li>
                <a href="{{ route('admin.pengguna') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                          {{ request()->routeIs('admin.pengguna*')
                              ? 'bg-green-50 text-green-700 font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="flex items-center justify-center w-6 mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </span>
                    Pengguna
                </a>
            </li>

            <li class="px-3">
                <div class="border-t border-gray-200"></div>
            </li>

            <li>
                <a href="{{ route('admin.laporan') }}"
                    class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                          {{ request()->routeIs('admin.laporan*')
                              ? 'bg-green-50 text-green-700 font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="flex items-center justify-center w-6 mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </span>
                    Laporan
                </a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-gray-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
