<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StuntingCare - Deteksi & Edukasi</title>
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
<body class="bg-gray-50 text-gray-800">



    @include('layouts.navigation_custom')

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-20 py-10 text-center text-gray-500">
        <p>&copy; 2026 StuntingCare. Dikembangkan dengan ❤️ oleh Mahasiswa Informatika.</p>
    </footer>

    @include('components.chatbot-popup')
    <script>
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