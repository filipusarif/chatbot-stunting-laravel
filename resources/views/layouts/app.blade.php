<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StuntingCare - Deteksi & Edukasi</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom smooth scroll */
        html { scroll-behavior: smooth; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    keyframes: {
                        bounceCustom: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-4px)' },
                        }
                    },
                    animation: {
                        'bounce-slow': 'bounceCustom 1s infinite',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased" x-data="{ isSideBarOpen: false }">

    @if(request()->is('admin*') || request()->is('profile*'))
        {{-- LAYOUT KHUSUS ADMIN (DENGAN SIDEBAR) --}}
        <div class="flex min-h-screen">
            <div x-show="isSideBarOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="isSideBarOpen = false"
                 class="fixed inset-0 bg-black/50 z-40 md:hidden" 
                 style="display: none;"></div>    

            <aside :class="isSideBarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="fixed md:static inset-y-0 left-0 w-72 bg-white border-r border-gray-100 flex flex-col z-50 transition-transform duration-300 ease-in-out md:translate-x-0 h-screen shadow-sm">
                
                <div class="p-8 flex justify-between items-center">
                    <a href="/" class="flex items-center gap-2">
                        <span class="text-2xl bg-blue-600 text-white w-9 h-9 flex items-center justify-center rounded-xl font-black">S</span>
                        <span class="text-xl font-black text-gray-800 tracking-tight">Admin<span class="text-blue-600">Panel</span></span>
                    </a>
                    <button @click="isSideBarOpen = false" class="md:hidden text-gray-400 hover:text-red-500">✕</button>
                </div>

                <nav class="flex-1 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-600' }}">
                       <span>🏠</span> Dashboard
                    </a>
                    <a href="{{ route('admin.articles') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition {{ request()->routeIs('admin.articles*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-600' }}">
                       <span>📝</span> Artikel
                    </a>
                    <a href="{{ route('admin.users') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition {{ request()->routeIs('admin.users*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-600' }}">
                       <span>👥</span> Pengguna
                    </a>
                    <a href="{{ route('admin.settings') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-600' }}">
                       <span>⚙️</span> API Settings
                    </a>
                </nav>

                <div class="p-4 border-t border-gray-50">
                    <div class="bg-gray-50 rounded-[2rem] p-4">
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-3 group mb-4 p-2 rounded-2xl transition {{ request()->routeIs('profile.edit') ? 'bg-blue-100' : '' }}">
                            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold shadow-md shadow-blue-100 text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-[12px] font-bold text-gray-800 truncate leading-none">{{ auth()->user()->name }}</p>
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">Admin</p>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 bg-white text-red-500 border border-red-50 rounded-2xl text-[10px] font-black hover:bg-red-50 transition shadow-sm uppercase tracking-wider">
                                Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="flex-1 flex flex-col min-w-0">
                <header class="md:hidden bg-white border-b p-4 flex justify-between items-center sticky top-0 z-30">
                    <div class="flex items-center gap-3">
                        <button @click="isSideBarOpen = true" class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                        </button>
                        <span class="font-black text-gray-800 tracking-tight">Admin<span class="text-blue-600">Panel</span></span>
                    </div>
                </header>

                <main class="p-4 md:p-8">
                    @yield('content')
                </main>
            </div>
        </div>

    @else
        {{-- LAYOUT PUBLIK (LANDING PAGE, DETEKSI, DLL) --}}
        @include('layouts.navigation_custom')

        <main>
            @yield('content')
        </main>

        <footer class="bg-white border-t-4 border-black mt-20 py-10">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center flex-wrap gap-4">
                <p class="font-bold uppercase tracking-tighter">© 2026 STUNTINGCARE</p>
                <div class="flex gap-6 text-xs font-mono uppercase">
                    <a href="/login" class="text-gray-400 hover:text-black transition-colors">[ Admin Access ]</a>
                </div>
            </div>
        </footer>

        @include('components.chatbot-popup')
    @endif

    @include('components.chatbot-popup')
    <script>
        function toggleMobileMenu() {
            // Anda bisa menambahkan logic sidebar mobile di sini jika perlu
            alert('Sidebar mobile bisa Anda kembangkan dengan slide-over menu!');
        }

        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            // Toggle visibility menu
            menu.classList.toggle('hidden');
            
            // Toggle icon antara hamburger (baris 3) dan close (X)
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    </script>
</body>
</html>