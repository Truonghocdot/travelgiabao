<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Tìm kiếm vé máy bay giá rẻ') | giabaotravel</title>
    <meta name="description" content="@yield('meta_description', 'giabaotravel - Đại lý vé máy bay uy tín hàng đầu Việt Nam. Đặt vé nhanh chóng, an toàn với giá cạnh tranh nhất.')">
    <meta name="keywords" content="@yield('meta_keywords', 'vé máy bay, đặt vé máy bay, giá rẻ, giabaotravel, du lịch, Vietnam Airlines, Vietjet Air, Bamboo Airways')">
    <meta name="author" content="giabaotravel">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Tìm kiếm vé máy bay giá rẻ') | giabaotravel">
    <meta property="og:description" content="@yield('meta_description', 'giabaotravel - Đại lý vé máy bay uy tín hàng đầu Việt Nam.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="giabaotravel">
    <meta property="og:locale" content="vi_VN">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 transition-colors duration-300 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <header class="bg-primary text-white py-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2 z-50 relative">
                <span class="material-icons text-3xl">flight_takeoff</span>
                <span class="text-2xl font-bold tracking-tight">giabaotravel</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 font-medium" aria-label="Main navigation">
                <a class="hover:text-blue-200 transition {{ request()->is('/') ? 'border-b-2 border-white pb-1 font-bold' : '' }}" href="{{ url('/') }}">Trang chủ</a>
                <a class="hover:text-blue-200 transition {{ request()->is('schedule*') ? 'border-b-2 border-white pb-1 font-bold' : '' }}" href="{{ url('/schedule') }}">Chuyến bay</a>
                <a class="hover:text-blue-200 transition {{ request()->is('tin-tuc*') ? 'border-b-2 border-white pb-1 font-bold' : '' }}" href="{{ url('/tin-tuc') }}">Tin tức</a>
                <a class="hover:text-blue-200 transition {{ request()->is('about*') ? 'border-b-2 border-white pb-1 font-bold' : '' }}" href="{{ url('/about') }}">Về chúng tôi</a>
                <a class="hover:text-blue-200 transition {{ request()->is('contact*') ? 'border-b-2 border-white pb-1 font-bold' : '' }}" href="{{ url('/contact') }}">Liên hệ</a>
            </nav>

            <div class="flex items-center space-x-4 z-50 relative">
                <button class="p-2 rounded-full hover:bg-blue-600 transition"
                    onclick="document.documentElement.classList.toggle('dark')" title="Chế độ tối" aria-label="Chuyển chế độ sáng/tối">
                    <span class="material-icons">dark_mode</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-primary/95 backdrop-blur-md border-t border-blue-700 shadow-xl">
            <nav class="flex flex-col px-6 py-4 space-y-4 font-medium pb-6" aria-label="Mobile navigation">
                <a class="hover:text-blue-200 transition block" href="{{ url('/') }}">Trang chủ</a>
                <a class="hover:text-blue-200 transition block" href="{{ url('/schedule') }}">Chuyến bay</a>
                <a class="hover:text-blue-200 transition block" href="{{ url('/tin-tuc') }}">Tin tức</a>
                <a class="hover:text-blue-200 transition block" href="{{ url('/about') }}">Về chúng tôi</a>
                <a class="hover:text-blue-200 transition block" href="{{ url('/contact') }}">Liên hệ</a>
                <button class="bg-white text-primary px-5 py-3 rounded-xl font-bold flex items-center justify-center space-x-2 mt-4 sm:hidden w-full shadow-md">
                    <span class="material-icons text-sm">person</span>
                    <span>Tài khoản</span>
                </button>
            </nav>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const btn = document.getElementById('mobile-menu-btn');
                const menu = document.getElementById('mobile-menu');
                if (btn && menu) {
                    btn.addEventListener('click', () => {
                        menu.classList.toggle('hidden');
                        const icon = btn.querySelector('.material-icons');
                        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
                    });
                }
            });
        </script>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-slate-100 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12 mt-auto">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 text-primary">
                        <span class="material-icons text-2xl">flight_takeoff</span>
                        <span class="text-xl font-bold tracking-tight">giabaotravel</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                        Đại lý vé máy bay uy tín hàng đầu Việt Nam. Chúng tôi cung cấp giải pháp đặt vé nhanh chóng, an toàn với giá cạnh tranh nhất.
                    </p>
                </div>
                <div>
                    <h4 class="text-slate-900 dark:text-white font-bold mb-4">Dịch vụ</h4>
                    <ul class="text-slate-500 dark:text-slate-400 text-sm space-y-2">
                        <li><a class="hover:text-primary transition" href="{{ url('/schedule') }}">Đặt vé máy bay</a></li>
                        <li><a class="hover:text-primary transition" href="{{ url('/tin-tuc') }}">Tin tức du lịch</a></li>
                        <li><a class="hover:text-primary transition" href="#">Combo du lịch</a></li>
                        <li><a class="hover:text-primary transition" href="#">Tour trọn gói</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 dark:text-white font-bold mb-4">Hỗ trợ</h4>
                    <ul class="text-slate-500 dark:text-slate-400 text-sm space-y-2">
                        <li><a class="hover:text-primary transition" href="{{ url('/contact') }}">Trung tâm trợ giúp</a></li>
                        <li><a class="hover:text-primary transition" href="#">Hướng dẫn thanh toán</a></li>
                        <li><a class="hover:text-primary transition" href="#">Chính sách đổi trả</a></li>
                        <li><a class="hover:text-primary transition" href="#">Bảo mật thông tin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 dark:text-white font-bold mb-4">Kết nối</h4>
                    <div class="flex space-x-4 mb-4">
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#" aria-label="Facebook"><span class="material-icons">facebook</span></a>
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#" aria-label="Instagram"><span class="material-icons">photo_camera</span></a>
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#" aria-label="Email"><span class="material-icons">mail</span></a>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Hotline: 1900 1234 (24/7)</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 space-y-4 md:space-y-0">
                <p>&copy; 2026 giabaotravel. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a class="hover:text-primary transition" href="{{ url('/about') }}">Về chúng tôi</a>
                    <a class="hover:text-primary transition" href="{{ url('/tin-tuc') }}">Tin tức</a>
                    <a class="hover:text-primary transition" href="{{ url('/contact') }}">Liên hệ</a>
                    <a class="hover:text-primary transition" href="#">Điều khoản dịch vụ</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Floating Contact Bar --}}
    <div class="fixed bottom-6 right-6 flex flex-col space-y-3 z-[9999]">
        <a href="https://zalo.me/0981119692" target="_blank" rel="noopener noreferrer" aria-label="Chat Zalo" class="w-12 h-12 bg-[#0068FF] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform hover:shadow-xl relative group cursor-pointer border-2 border-white dark:border-slate-800">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="absolaute right-full mr-3 bg-white text-slate-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Zalo</span>
        </a>
        <a href="viber://chat?number=0981119692" target="_blank" rel="noopener noreferrer" aria-label="Chat Viber" class="w-12 h-12 bg-[#7360F2] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform hover:shadow-xl relative group cursor-pointer border-2 border-white dark:border-slate-800">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.336 10.605c.026-6.17-5.008-10.605-11.31-10.605C1.868 0 .093 4.312.093 10.222c0 2.545.926 4.982 2.658 6.865l-1.096 4.978 4.674-1.905c1.474.39 3.036.594 4.697.594 6.302 0 11.31-4.435 11.31-10.6050v.456z" />
            </svg>
            <span class="absolute right-full mr-3 bg-white text-slate-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Viber</span>
        </a>
        <a href="https://wa.me/0981119692" target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp" class="w-12 h-12 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform hover:shadow-xl relative group cursor-pointer border-2 border-white dark:border-slate-800">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.031 0A12 12 0 00.323 18.257L0 24l5.885-1.54A11.968 11.968 0 0012.031 24c6.626 0 12-5.372 12-12s-5.374-12-12-12zm6.653 17.202c-.302.847-1.749 1.616-2.42 1.685-.603.061-1.383.17-3.95-1.026-3.085-1.433-5.068-4.593-5.221-4.801-.153-.21-1.246-1.664-1.246-3.173 0-1.508.789-2.253 1.074-2.559.283-.306.618-.383.823-.383.204 0 .408.005.587.014.195.009.458-.076.716.549.273.66.93 2.274 1.011 2.438.082.162.137.352.034.557-.101.205-.152.33-.305.512-.152.18-.316.386-.45.549-.144.173-.302.366-.129.664.173.298.77 1.274 1.656 2.065 1.144 1.022 2.107 1.338 2.396 1.493.289.153.46.128.633-.06.173-.187.751-.873.953-1.173.203-.301.405-.251.67-.153.264.098 1.676.789 1.964.933.288.143.481.214.55.333.07.119.07.69-.232 1.537z" />
            </svg>
            <span class="absolute right-full mr-3 bg-white text-slate-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">WhatsApp</span>
        </a>
    </div>

    @stack('scripts')
</body>

</html>