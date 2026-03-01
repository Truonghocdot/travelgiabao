@extends('layouts.app')

@section('title', 'Danh sách Tin tức')

@section('content')

            <div class="w-full max-w-[1200px] px-4 md:px-10 py-8">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">Tin tức &amp; Ưu đãi
                    </h1>
                    <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                        <span class="material-symbols-outlined text-base">calendar_today</span>
                        <span>Thứ Tư, 24 Tháng 5, 2024</span>
                    </div>
                </div>
                <div class="@container mb-12">
                    <div
                        class="relative group cursor-pointer overflow-hidden rounded-2xl bg-slate-900 aspect-[21/9] min-h-[350px] flex flex-col justify-end shadow-xl">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                            data-alt="Stunning sunset view of a tropical island beach"
                            style='background-image: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBp_avQg_Rm1aL9-901P5RIvoy-kGByK-WXA0Rd4QjcvdcOdj329v6BVd8Q6GRwTo2kHbfipLz7tzVo5dNjkVcB7XMQqsAgoRUgxN7PvFx2zEh4PzfNW6johrMeW_RtLWyPZSOhYJYeMN_dHudTb8dnVFecINMcTNNukAAbzyn6B9ggzDYSpAe4oMi-TiDoO6etnS9nzYmyx95uYapsJaQdP7dIxX2qCdW80snFC1D0dl1z4TjzLlcRG9u7Y1vr5LwjifPfHPuANGI");'>
                        </div>
                        <div class="relative p-6 md:p-12 max-w-4xl">
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 bg-primary text-white text-xs font-bold uppercase tracking-wider rounded-md mb-4 shadow-lg">
                                <span class="material-symbols-outlined text-sm">stars</span>
                                Tin nổi bật
                            </span>
                            <h2
                                class="text-white text-3xl md:text-5xl font-extrabold leading-tight mb-4 tracking-tight drop-shadow-md">
                                Cẩm nang du lịch bền vững: Khám phá thế giới một cách trách nhiệm trong năm 2024</h2>
                            <p class="text-slate-200 text-lg mb-8 line-clamp-2 max-w-2xl font-medium">Tìm hiểu cách giảm
                                thiểu dấu chân carbon trong khi vẫn tận hưởng những điểm đến ngoạn mục nhất hành tinh mà
                                không ảnh hưởng đến sự thoải mái.</p>
                            <div class="flex flex-wrap items-center gap-6">
                                <button
                                    class="flex items-center justify-center rounded-lg h-12 px-8 bg-white text-primary text-sm font-bold transition-all hover:bg-slate-100 hover:scale-105 shadow-lg">
                                    Đọc chi tiết
                                </button>
                                <div class="flex items-center gap-3 text-slate-300 text-sm font-medium">
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-base">schedule</span> 12 phút
                                        đọc</span>
                                    <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-base">person</span> Bởi Gia Bảo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-10 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex overflow-x-auto no-scrollbar gap-8 pb-px">
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-primary text-primary pb-4 whitespace-nowrap"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Tất cả</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 pb-4 whitespace-nowrap transition-colors"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Mẹo du lịch</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 pb-4 whitespace-nowrap transition-colors"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Tin hàng không</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 pb-4 whitespace-nowrap transition-colors"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Khuyến mãi</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 pb-4 whitespace-nowrap transition-colors"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Cẩm nang điểm đến</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 pb-4 whitespace-nowrap transition-colors"
                            href="#">
                            <p class="text-sm font-bold tracking-[0.015em]">Sự kiện</p>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Mountain range covered in mist and clouds"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAQaD_32TYTnqIA5VekFrP0B9A55gROzW4sT-mryfG5ve_PD7hTEhL1sA6UBNZaX9Gu5Nbre4ya8_z28Lz1q87FjrfOGkLzMNbjwsambeXrDoHjRrw2r1HwHGi9kAah92iBNDEAyqWTvp0Kl6RRlZuSPcbzFHrsNHmFtVuBsPVuUJUcaVNwyFfuPvzketKFF_L8ykbci-uu9JBLBhV177m1wL8bYsVPN7OF0sjM9mQLPgC19-tzQtzrr_gQbPQgeGAycphfLu33Oo0");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Cẩm
                                nang</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>24/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                Vẻ đẹp tiềm ẩn của dãy Alps Thụy Sĩ</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">
                                Thoát khỏi đám đông và khám phá những thung lũng bí mật, hồ nước màu ngọc bích và những
                                ngôi làng cổ kính mà hầu hết du khách bỏ lỡ.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    8 phút
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Interior of a modern luxury airplane cabin"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC-APz6AT2eeH0D1iiTPjKm3qHDm-Q4f9o_Zi3Ol8K4sXMFOBrbYOYzAi1qBiprpto3jFf2fJfSVFCrJarBvdCMcqQLpLBt7rtL5oztq4O4kXuSJkUUFwe26VNr5ahpVPS8F-Cqt6vwOvIJtMx5aWX0R8TZhNHo2rB-H7l3Ojvt8hCLXU1oQVqeZiDQYKnAEOEC2SUe5hMvIMrJVwGWfPmHXscBDpmCsb8rE5HDbSFotSMewusymmZLqCBdo3onkUBK_xdpMepgwBA");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Tin
                                hàng không</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>22/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                Công bố các đường bay thẳng mới đến Tokyo</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">Du
                                lịch đến Nhật Bản trở nên dễ dàng hơn bao giờ hết với việc ba hãng hàng không lớn ra mắt
                                các chuyến bay không dừng từ mùa hè này.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    5 phút
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Colorful street food market in Southeast Asia"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCo8e1VW3E3d0F_Jib7Bi-GDUiGsgEl11FX-Smjl1alT3taSo4Wh_6a4CHaEPxNCfKYPBl3PahoGioC8gGjnwHkQ9zFLAOrE1T4J0Rk8f_ncTvORxK19dYUtJ3mXS1ikFiaWWrn6Tv1AGl__JBTO3DQ-DFaV0nL4bCSovAPRgHrqi9gIsEaeDxRuh7humu2xD0vlI5yNvLq5PRz7asWYJ5H-B2KDMmGbMSkDrOCB5pWE4eVPwzcBxw-KxnmddhTthZbiocH-v1apEM");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Mẹo
                                du lịch</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>20/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                10 món ăn đường phố phải thử tại Bangkok</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">Từ
                                món Pad Thai nổi tiếng thế giới đến những đặc sản địa phương ít người biết, đây là danh
                                sách những món ăn đường phố ngon nhất tại thủ đô Thái Lan.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    10 phút
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Luxury resort swimming pool overlooking the ocean"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB5zPvYl_Q40WsQRgbHux6Cq5zFSCHyU5E6VHzgDbehpz5eatQdMoWly2EMPY7Y9GCA-b9a6xlNk0kR1BF5XVswKKrT24APaE5Zr3cJmFG-wajt5jyRREs-4kzn4rTqqeoXAa2t8W8kD_Vzi6uIgpVWd8jbdMULfCpRm704iJFYyJsB4nwPzi3NxL1SCFSlOkOyKgVBOmlTVu8Dto4Rp0515ka-wmLuy2XL_QEX36qRHYgproomayHtMZUCD9-A2N64FZqfyCMSd7o");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Khuyến
                                mãi</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>18/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                Ưu đãi hè sớm: Giảm giá lên đến 40%</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">Đặt
                                kỳ nghỉ hè mơ ước của bạn trước cuối tháng này và tận hưởng các ưu đãi độc quyền tại các
                                khu nghỉ dưỡng ven biển hàng đầu.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    3 phút
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Modern backpacker with a camera in a historic city"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDS4oITHHx2sAconevCcceaX-tSjQjYTFNeJ_YnCbg7mYSgkYfauq-EyPt77AvAdzvO4ewi-QNql7KD9tW0OULMHkj4t2ERbH11gMiZQBFBgoe3GnL_d89l36-fqbcRI8lzWlBeYCrB-tFSXvcvBkbzw3I3ZkZQteyozgLqVe44GST3e_OMWNjjAGXhwSlDTm0OPs0RTO6bYhPvgS8_JpOASjAlU4V94594NRqrRbp5-6wfi1CZ5CrX_824Vgppk8zYNqnlmFNqNuI");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Mẹo
                                du lịch</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>15/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                Cách du lịch gọn nhẹ: Phương pháp "Một túi"</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">Lời
                                khuyên từ chuyên gia về cách đóng gói hành lý hiệu quả để bạn có thể bỏ qua khu vực chờ
                                lấy hành lý và tận hưởng chuyến đi không rắc rối.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    6 phút
                                </span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-800 group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video w-full overflow-hidden relative">
                            <div class="w-full h-full bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
                                data-alt="Aurora borealis lighting up the night sky over a forest"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC-YcHwJaO-8UmogJWMHDh6CS8isTHhDMzl6SxNA9j1tRPXfiNOWcvo3BskenY9lysglaEWF8zFADSNFUN6jLe7WFxZ93Ewp3o9vTlHNWOCrSv06hjJ9qDVa4eok2yQRWPKQhZsjrNOffvz_ADKKemVPgFafD5f13lRz4bzCxXsYI9ZPiGA4W8dJaac7biQpqHVewphYM5GDPubbwszG830PLE1oNGDwBKCsGrWHVAJIrK3hs_WFDZVQCF5RpB-EWc3LsZIHExFong");'>
                            </div>
                            <span
                                class="absolute top-4 left-4 text-[10px] font-bold text-white uppercase bg-primary px-2.5 py-1 rounded shadow-sm">Cẩm
                                nang</span>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span>12/05/2024</span>
                            </div>
                            <h3
                                class="text-slate-900 dark:text-white text-xl font-bold mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                Săn cực quang: Những điểm tốt nhất ở Iceland</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">
                                Hướng dẫn đầy đủ để chứng kiến hiện tượng Bắc cực quang kỳ ảo, bao gồm thời gian, địa
                                điểm và các mẹo chụp ảnh chuyên nghiệp.</p>
                            <div
                                class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a class="text-primary text-sm font-bold flex items-center gap-1 group/link" href="#">
                                    Đọc thêm
                                    <span
                                        class="material-symbols-outlined text-base transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                                </a>
                                <span
                                    class="text-slate-400 text-[11px] flex items-center gap-1 uppercase font-bold tracking-wider">
                                    <span class="material-symbols-outlined text-sm">timer</span>
                                    15 phút
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-16 flex justify-center items-center gap-3">
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all duration-300 shadow-sm">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white font-bold shadow-lg">1</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors font-bold">2</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors font-bold">3</button>
                    <span class="px-2 text-slate-400 font-medium">...</span>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors font-bold">12</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white transition-all duration-300 shadow-sm">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </main>
        <section class="bg-primary/5 dark:bg-primary/10 border-y border-primary/10 py-16 mt-12">
            <div class="max-w-[1200px] mx-auto px-4 md:px-10 text-center">
                <span class="material-symbols-outlined text-primary text-5xl mb-6">mail</span>
                <h2 class="text-slate-900 dark:text-white text-2xl md:text-4xl font-extrabold mb-4 tracking-tight">Nhận
                    bản tin du lịch mới nhất</h2>
                <p class="text-slate-600 dark:text-slate-400 mb-10 max-w-2xl mx-auto text-lg">Đăng ký nhận bản tin của
                    chúng tôi để cập nhật các hướng dẫn du lịch, ưu đãi độc quyền và tin tức ngành hàng tuần.</p>
                <form class="flex flex-col md:flex-row gap-4 max-w-xl mx-auto">
                    <input
                        class="flex-1 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 focus:ring-primary focus:border-primary px-6 py-4 text-sm shadow-sm"
                        placeholder="Địa chỉ email của bạn" required="" type="email" />
                    <button
                        class="bg-primary text-white font-extrabold py-4 px-10 rounded-xl hover:bg-primary/90 hover:scale-[1.02] transition-all shadow-lg active:scale-95"
                        type="submit">Đăng ký ngay</button>
                </form>
            </div>
        </section>
@endsection
