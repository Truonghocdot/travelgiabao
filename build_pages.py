import os
import re

# 1. Update index.html form
with open("index.html", "r", encoding="utf-8") as f:
    idx_content = f.read()

form_html = """<form action="schedule.html" method="GET" class="w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm khởi hành</label>
                            <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                                <span class="material-icons text-slate-400 mr-2">flight_takeoff</span>
                                <input name="from" class="bg-transparent border-none focus:ring-0 w-full p-0" placeholder="Hà Nội (HAN)" value="Hà Nội (HAN)" type="text" />
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Điểm đến</label>
                            <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                                <span class="material-icons text-slate-400 mr-2">flight_land</span>
                                <input name="to" class="bg-transparent border-none focus:ring-0 w-full p-0" placeholder="Đà Nẵng (DAD)" value="Đà Nẵng (DAD)" type="text" />
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Ngày đi - Ngày về</label>
                            <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                                <span class="material-icons text-slate-400 mr-2">calendar_today</span>
                                <input name="date" class="bg-transparent border-none focus:ring-0 w-full p-0" placeholder="25/12/2023 - 30/12/2023" value="25/12/2023 - 30/12/2023" type="text" />
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 ml-1">Số hành khách</label>
                            <div class="flex items-center border border-slate-300 dark:border-slate-600 rounded-xl p-3 bg-white dark:bg-slate-700">
                                <span class="material-icons text-slate-400 mr-2">group</span>
                                <select name="passengers" class="bg-transparent border-none focus:ring-0 w-full p-0 outline-none">
                                    <option value="1 người lớn, Phổ thông">1 người lớn, Phổ thông</option>
                                    <option value="2 người lớn, Phổ thông">2 người lớn, Phổ thông</option>
                                    <option value="1 người lớn, Thương gia">1 người lớn, Thương gia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg flex items-center justify-center space-x-2 transition-all transform hover:scale-[1.01] active:scale-95">
                        <span class="material-icons">search</span>
                        <span>Tìm kiếm chuyến bay</span>
                    </button>
                    </form>"""

idx_content = re.sub(r'<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">.*?</button>', form_html, idx_content, flags=re.DOTALL)
with open("index.html", "w", encoding="utf-8") as f:
    f.write(idx_content)

# 2. Template for header and footer unifying
header_template = """    <header class="bg-primary text-white py-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="index.html" class="flex items-center space-x-2">
                <span class="material-icons text-3xl">flight_takeoff</span>
                <span class="text-2xl font-bold tracking-tight">giabaotravel</span>
            </a>
            <nav class="hidden md:flex space-x-6 font-medium">
                <a class="hover:text-blue-200 transition __NAV_INDEX__" href="index.html">Trang chủ</a>
                <a class="hover:text-blue-200 transition __NAV_SCHEDULE__" href="schedule.html">Chuyến bay</a>
                <a class="hover:text-blue-200 transition __NAV_TOUR__" href="detail.html">Tour du lịch</a>
                <a class="hover:text-blue-200 transition __NAV_BLOG__" href="blog.html">Tin tức</a>
                <a class="hover:text-blue-200 transition __NAV_ABOUT__" href="about.html">Về chúng tôi</a>
                <a class="hover:text-blue-200 transition __NAV_CONTACT__" href="contact.html">Liên hệ</a>
            </nav>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-blue-600 transition"
                    onclick="document.documentElement.classList.toggle('dark')">
                    <span class="material-icons">dark_mode</span>
                </button>
                <button
                    class="bg-white text-primary px-5 py-2 rounded-full font-semibold flex items-center space-x-2 hover:bg-blue-50 transition shadow-md">
                    <span class="material-icons text-sm">person</span>
                    <span class="hidden sm:inline">Tài khoản</span>
                </button>
            </div>
        </div>
    </header>"""

footer_template = """    <footer class="bg-slate-100 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12 mt-auto">
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
                        <li><a class="hover:text-primary transition" href="schedule.html">Đặt vé máy bay</a></li>
                        <li><a class="hover:text-primary transition" href="detail.html">Đặt khách sạn</a></li>
                        <li><a class="hover:text-primary transition" href="#">Combo du lịch</a></li>
                        <li><a class="hover:text-primary transition" href="detail.html">Tour trọn gói</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 dark:text-white font-bold mb-4">Hỗ trợ</h4>
                    <ul class="text-slate-500 dark:text-slate-400 text-sm space-y-2">
                        <li><a class="hover:text-primary transition" href="contact.html">Trung tâm trợ giúp</a></li>
                        <li><a class="hover:text-primary transition" href="#">Hướng dẫn thanh toán</a></li>
                        <li><a class="hover:text-primary transition" href="#">Chính sách đổi trả</a></li>
                        <li><a class="hover:text-primary transition" href="#">Bảo mật thông tin</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-900 dark:text-white font-bold mb-4">Kết nối</h4>
                    <div class="flex space-x-4 mb-4">
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#"><span class="material-icons">facebook</span></a>
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#"><span class="material-icons">photo_camera</span></a>
                        <a class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm hover:text-primary transition" href="#"><span class="material-icons">mail</span></a>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Hotline: 1900 1234 (24/7)</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 space-y-4 md:space-y-0">
                <p>© 2026 giabaotravel. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a class="hover:text-primary transition" href="about.html">Về chúng tôi</a>
                    <a class="hover:text-primary transition" href="contact.html">Liên hệ</a>
                    <a class="hover:text-primary transition" href="#">Điều khoản dịch vụ</a>
                    <a class="hover:text-primary transition" href="#">Chính sách bảo mật</a>
                </div>
            </div>
        </div>
    </footer>"""

html_head = """<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>giabaotravel - {title}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {{
            darkMode: "class",
            theme: {{
                extend: {{
                    colors: {{
                        primary: "#1d4ed8",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                    }},
                    fontFamily: {{
                        display: ["Inter", "sans-serif"],
                    }},
                    borderRadius: {{
                        DEFAULT: "0.75rem",
                    }},
                }}
            }}
        }};
    </script>
    <style>body {{ font-family: 'Inter', sans-serif; }}</style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 flex flex-col min-h-screen">
<header></header>
<main class="flex-grow">
{main}
</main>
<footer></footer>
</body>
</html>
"""

schedule_main = """
<div class="container mx-auto px-6 py-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm p-6 mb-8 flex flex-col md:flex-row justify-between items-center border border-slate-200 dark:border-slate-700">
        <div>
            <h1 class="text-2xl font-bold flex items-center mb-2">
                <span id="display-from">Hà Nội (HAN)</span> 
                <span class="material-icons mx-3 text-slate-400">arrow_forward</span> 
                <span id="display-to">Đà Nẵng (DAD)</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 flex items-center">
                <span class="material-icons text-sm mr-1">calendar_today</span> <span id="display-date">25/12/2023 - 30/12/2023</span> | 
                <span class="material-icons text-sm ml-3 mr-1">group</span> <span id="display-passengers">1 người lớn, Phổ thông</span>
            </p>
        </div>
        <button onclick="window.location.href='index.html'" class="mt-4 md:mt-0 bg-primary/10 text-primary px-6 py-2 rounded-xl font-semibold hover:bg-primary/20 transition">Tìm kiếm khác</button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                <h3 class="font-bold text-lg mb-4">Hãng hàng không</h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" checked class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Vietnam Airlines</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" checked class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Vietjet Air</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" checked class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Bamboo Airways</span>
                    </label>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
                <h3 class="font-bold text-lg mb-4">Thời gian bay</h3>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Sáng (00:00 - 12:00)</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Chiều (12:00 - 18:00)</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" class="rounded text-primary focus:ring-primary border-slate-300">
                        <span>Tối (18:00 - 24:00)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Flights List -->
        <div class="lg:col-span-3 space-y-4">
            <!-- Flight Item 1 -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:border-primary transition group">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center space-x-4 w-full md:w-auto">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-blue-600">VN</div>
                        <div>
                            <div class="font-bold">Vietnam Airlines</div>
                            <div class="text-xs text-slate-500">VN-123 • Airbus A321</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between flex-1 w-full px-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">08:00</div>
                            <div class="text-sm text-slate-500 from-display">HAN</div>
                        </div>
                        <div class="flex flex-col items-center px-4 flex-1">
                            <div class="text-xs text-slate-400 mb-1">1h 20m</div>
                            <div class="w-full flex items-center">
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                                <span class="material-icons text-slate-300 dark:text-slate-600 mx-2 transform rotate-90 text-sm">flight</span>
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                            </div>
                            <div class="text-xs text-slate-400 mt-1">Bay thẳng</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">09:20</div>
                            <div class="text-sm text-slate-500 to-display">DAD</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-row md:flex-col items-center md:items-end justify-between w-full md:w-auto mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-700">
                        <div class="text-2xl font-bold text-orange-500 mb-2">1.250.000đ</div>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-orange-600 transition transform group-hover:scale-105 shadow-md">Chọn vé</button>
                    </div>
                </div>
            </div>

            <!-- Flight Item 2 -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:border-primary transition group">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center space-x-4 w-full md:w-auto">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-red-500">VJ</div>
                        <div>
                            <div class="font-bold">Vietjet Air</div>
                            <div class="text-xs text-slate-500">VJ-456 • Airbus A320</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between flex-1 w-full px-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">10:15</div>
                            <div class="text-sm text-slate-500 from-display">HAN</div>
                        </div>
                        <div class="flex flex-col items-center px-4 flex-1">
                            <div class="text-xs text-slate-400 mb-1">1h 15m</div>
                            <div class="w-full flex items-center">
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                                <span class="material-icons text-slate-300 dark:text-slate-600 mx-2 transform rotate-90 text-sm">flight</span>
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                            </div>
                            <div class="text-xs text-slate-400 mt-1">Bay thẳng</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">11:30</div>
                            <div class="text-sm text-slate-500 to-display">DAD</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-row md:flex-col items-center md:items-end justify-between w-full md:w-auto mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-700">
                        <div class="text-2xl font-bold text-orange-500 mb-2">980.000đ</div>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-orange-600 transition transform group-hover:scale-105 shadow-md">Chọn vé</button>
                    </div>
                </div>
            </div>

            <!-- Flight Item 3 -->
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:border-primary transition group">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center space-x-4 w-full md:w-auto">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white shadow-md bg-green-600">QH</div>
                        <div>
                            <div class="font-bold">Bamboo Airways</div>
                            <div class="text-xs text-slate-500">QH-789 • Boeing 787</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between flex-1 w-full px-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">14:45</div>
                            <div class="text-sm text-slate-500 from-display">HAN</div>
                        </div>
                        <div class="flex flex-col items-center px-4 flex-1">
                            <div class="text-xs text-slate-400 mb-1">1h 20m</div>
                            <div class="w-full flex items-center">
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                                <span class="material-icons text-slate-300 dark:text-slate-600 mx-2 transform rotate-90 text-sm">flight</span>
                                <div class="h-px bg-slate-300 dark:bg-slate-600 flex-1"></div>
                            </div>
                            <div class="text-xs text-slate-400 mt-1">Bay thẳng</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-slate-800 dark:text-slate-100">16:05</div>
                            <div class="text-sm text-slate-500 to-display">DAD</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-row md:flex-col items-center md:items-end justify-between w-full md:w-auto mt-4 md:mt-0 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-700">
                        <div class="text-2xl font-bold text-orange-500 mb-2">1.100.000đ</div>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-orange-600 transition transform group-hover:scale-105 shadow-md">Chọn vé</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    // Handle query params to update the UI dynamically
    const params = new URLSearchParams(window.location.search);
    if(params.get('from')) {
        document.getElementById('display-from').textContent = params.get('from');
        document.querySelectorAll('.from-display').forEach(el => el.textContent = params.get('from').split('(')[1]?.replace(')','') || 'HAN');
    }
    if(params.get('to')) {
        document.getElementById('display-to').textContent = params.get('to');
        document.querySelectorAll('.to-display').forEach(el => el.textContent = params.get('to').split('(')[1]?.replace(')','') || 'DAD');
    }
    if(params.get('date')) document.getElementById('display-date').textContent = params.get('date');
    if(params.get('passengers')) document.getElementById('display-passengers').textContent = params.get('passengers');
</script>
"""

contact_main = """
<div class="container mx-auto px-6 py-16 flex-grow">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Liên hệ với chúng tôi</h1>
        <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn 24/7. Hãy gọi hoặc gửi tin nhắn, chúng tôi sẽ phản hồi sớm nhất.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto">
        <!-- Contact Form -->
        <div>
            <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                <h2 class="text-2xl font-bold mb-6">Gửi tin nhắn</h2>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Họ và tên</label>
                        <input type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Nhập tên của bạn" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                        <input type="email" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="email@example.com" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Số điện thoại</label>
                        <input type="tel" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3" placeholder="Vd: 0912 345 678" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nội dung</label>
                        <textarea rows="4" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600 focus:border-primary focus:ring-primary rounded-xl px-4 py-3 resize-none" placeholder="Bạn cần hỗ trợ gì?" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02]">Gửi yêu cầu</button>
                </form>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8 flex flex-col justify-center">
            
            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary transition">
                <div class="bg-primary/10 text-primary p-4 rounded-full">
                    <span class="material-icons text-3xl">location_on</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Trụ sở chính</h4>
                    <p class="text-slate-600 dark:text-slate-400">Tầng 15, Tòa nhà Travel Center<br>123 Đường Du Lịch, Quận Hoàn Kiếm<br>Thủ đô Hà Nội, Việt Nam</p>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-green-500 transition">
                <div class="bg-green-500/10 text-green-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">call</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Đường dây nóng (24/7)</h4>
                    <p class="text-slate-600 dark:text-slate-400 font-medium text-lg">1900 1234<br>
                    <span class="text-sm font-normal text-slate-500 mt-1 block">Giải đáp thắc mắc và hỗ trợ đặt vé khẩn cấp</span></p>
                </div>
            </div>

            <div class="flex items-start space-x-6 p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:border-orange-500 transition">
                <div class="bg-orange-500/10 text-orange-500 p-4 rounded-full">
                    <span class="material-icons text-3xl">mail</span>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-2">Email hỗ trợ</h4>
                    <a href="mailto:support@giabaotravel.com" class="text-primary hover:underline font-medium text-lg">support@giabaotravel.com</a>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Phản hồi chậm nhất trong 24 giờ</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
"""

with open('schedule.html', 'w', encoding='utf-8') as f:
    f.write(html_head.format(title="Kết quả tìm kiếm", main=schedule_main))

with open('contact.html', 'w', encoding='utf-8') as f:
    f.write(html_head.format(title="Liên hệ", main=contact_main))

files = ['index.html', 'about.html', 'detail.html', 'blog.html', 'schedule.html', 'contact.html']

for file in files:
    if not os.path.exists(file): continue
    with open(file, 'r', encoding='utf-8') as f: content = f.read()

    # replace existing headers and footers
    # The regex might not easily match <header ..></header> if there are attributes on header
    # But for these simple files, it's <header ...>...</header>
    if "<header" in content and "</header>" in content:
        content = re.sub(r'<header.*?</header>', header_template, content, flags=re.DOTALL)
    else:
        # Just insert after body if no header exists (shouldn't happen)
        pass

    if "<footer" in content and "</footer>" in content:
        content = re.sub(r'<footer.*?</footer>', footer_template, content, flags=re.DOTALL)

    # Apply active classes
    active_map = {
        'index.html': '__NAV_INDEX__',
        'schedule.html': '__NAV_SCHEDULE__',
        'detail.html': '__NAV_TOUR__',
        'blog.html': '__NAV_BLOG__',
        'about.html': '__NAV_ABOUT__',
        'contact.html': '__NAV_CONTACT__'
    }
    
    for f_name, marker in active_map.items():
        if file == f_name:
            content = content.replace(marker, 'border-b-2 border-white pb-1 font-bold')
        else:
            content = content.replace(marker, '')

    # Fix weird Plus Jakarta Sans to Inter if tailwind config specifies inter natively
    if "Plus Jakarta Sans" in content and "font-family: 'Plus Jakarta Sans'" in content and not file in ['schedule.html', 'contact.html']:
        content = content.replace("Plus Jakarta Sans", "Inter")

    with open(file, 'w', encoding='utf-8') as f:
        f.write(content)

print("Updated all files successfully.")
