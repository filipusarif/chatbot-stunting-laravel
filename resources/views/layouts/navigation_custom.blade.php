    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <span class="text-3xl bg-blue-600 text-white w-10 h-10 flex items-center justify-center rounded-xl group-hover:rotate-6 transition-transform">S</span>
                        <span class="text-2xl font-black text-gray-800 tracking-tight">Stunting<span class="text-blue-600">Care</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8 font-semibold">
                    <a href="/" class="text-gray-600 hover:text-blue-600 transition">Beranda</a>
                    <a href="/deteksi" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">Cek Stunting</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500 font-bold px-4 py-2 hover:bg-red-50 rounded-lg">
                                Keluar
                            </button>
                        </form>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button onclick="toggleMenu()" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition">
                        <svg id="menu-icon" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg id="close-icon" class="h-7 w-7 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pt-2 pb-6 space-y-2 shadow-xl">
            <a href="/" class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">Beranda</a>
            <div class="pt-2">
                <a href="/deteksi" class="block w-full text-center bg-blue-600 text-white px-4 py-3 rounded-xl font-bold shadow-md shadow-blue-100 active:scale-95 transition">Cek Stunting Sekarang</a>
            </div>
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 font-bold px-4 py-2 hover:bg-red-50 rounded-lg">
                    Keluar
                </button>
            </form>
            @endauth
        </div>
    </nav>