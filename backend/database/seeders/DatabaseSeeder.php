<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Blog;
use App\Models\Flight;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@giabaotravel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Airlines
        $airlines = [
            ['name' => 'Vietnam Airlines', 'code' => 'VN', 'logo_color' => '#0062A0'],
            ['name' => 'Vietjet Air', 'code' => 'VJ', 'logo_color' => '#E60012'],
            ['name' => 'Bamboo Airways', 'code' => 'QH', 'logo_color' => '#00723F'],
            ['name' => 'Pacific Airlines', 'code' => 'BL', 'logo_color' => '#F7A600'],
            ['name' => 'Vietravel Airlines', 'code' => 'VU', 'logo_color' => '#003366'],
        ];
        foreach ($airlines as $a) {
            Airline::firstOrCreate(['code' => $a['code']], $a);
        }

        // ========== Việt Nam ==========
        $vn = Region::firstOrCreate(['name' => 'Việt Nam'], ['sort' => 1]);

        $mienBac = SubRegion::firstOrCreate(['name' => 'Miền Bắc', 'region_id' => $vn->id], ['sort' => 1]);
        $mienNam = SubRegion::firstOrCreate(['name' => 'Miền Nam', 'region_id' => $vn->id], ['sort' => 2]);
        $mienTrung = SubRegion::firstOrCreate(['name' => 'Miền Trung', 'region_id' => $vn->id], ['sort' => 3]);

        $vnAirports = [
            // Miền Bắc
            ['sub_region_id' => $mienBac->id, 'name' => 'Điện Biên Phủ', 'code' => 'DIN', 'base_price' => 1200000, 'min_price' => 1100000, 'max_price' => 2400000],
            ['sub_region_id' => $mienBac->id, 'name' => 'Hà Nội',        'code' => 'HAN', 'base_price' =>  890000, 'min_price' =>  793240, 'max_price' => 1602000],
            ['sub_region_id' => $mienBac->id, 'name' => 'Hải Phòng',     'code' => 'HPH', 'base_price' =>  950000, 'min_price' =>  850000, 'max_price' => 1800000],
            ['sub_region_id' => $mienBac->id, 'name' => 'Vân Đồn',       'code' => 'VDO', 'base_price' => 1100000, 'min_price' =>  980000, 'max_price' => 2000000],
            // Miền Nam
            ['sub_region_id' => $mienNam->id, 'name' => 'Hồ Chí Minh',   'code' => 'SGN', 'base_price' =>  890000, 'min_price' =>  793240, 'max_price' => 1602000],
            ['sub_region_id' => $mienNam->id, 'name' => 'Cà Mau',         'code' => 'CAH', 'base_price' => 1350000, 'min_price' => 1200000, 'max_price' => 2500000],
            ['sub_region_id' => $mienNam->id, 'name' => 'Phú Quốc',       'code' => 'PQC', 'base_price' => 1500000, 'min_price' => 1300000, 'max_price' => 2800000],
            ['sub_region_id' => $mienNam->id, 'name' => 'Cần Thơ',        'code' => 'VCA', 'base_price' => 1100000, 'min_price' =>  950000, 'max_price' => 2100000],
            ['sub_region_id' => $mienNam->id, 'name' => 'Côn Đảo',        'code' => 'VCS', 'base_price' => 1800000, 'min_price' => 1600000, 'max_price' => 3200000],
            ['sub_region_id' => $mienNam->id, 'name' => 'Kiên Giang',     'code' => 'VKG', 'base_price' => 1400000, 'min_price' => 1250000, 'max_price' => 2600000],
            // Miền Trung
            ['sub_region_id' => $mienTrung->id, 'name' => 'Ban Mê Thuột', 'code' => 'BMV', 'base_price' =>  980000, 'min_price' =>  880000, 'max_price' => 1900000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Nha Trang',    'code' => 'CXR', 'base_price' => 1050000, 'min_price' =>  950000, 'max_price' => 2000000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Đà Nẵng',      'code' => 'DAD', 'base_price' =>  950000, 'min_price' =>  850000, 'max_price' => 1800000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Đà Lạt',       'code' => 'DLI', 'base_price' => 1100000, 'min_price' =>  980000, 'max_price' => 2100000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Huế',           'code' => 'HUI', 'base_price' => 1000000, 'min_price' =>  900000, 'max_price' => 1950000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'PleiKu',        'code' => 'PXU', 'base_price' => 1050000, 'min_price' =>  950000, 'max_price' => 2000000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Tuy Hòa',      'code' => 'TBB', 'base_price' => 1150000, 'min_price' => 1050000, 'max_price' => 2200000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Thanh Hóa',    'code' => 'THD', 'base_price' =>  900000, 'min_price' =>  820000, 'max_price' => 1700000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Qui Nhơn',     'code' => 'UIH', 'base_price' => 1000000, 'min_price' =>  900000, 'max_price' => 1950000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Chu Lai',       'code' => 'VCL', 'base_price' => 1050000, 'min_price' =>  950000, 'max_price' => 2000000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Quảng Bình',   'code' => 'VDH', 'base_price' => 1100000, 'min_price' =>  990000, 'max_price' => 2100000],
            ['sub_region_id' => $mienTrung->id, 'name' => 'Vinh',          'code' => 'VII', 'base_price' =>  950000, 'min_price' =>  860000, 'max_price' => 1800000],
        ];
        foreach ($vnAirports as $ap) {
            Airport::firstOrCreate(['code' => $ap['code']], $ap);
        }


        // ========== Châu Á & Úc ==========
        $asia = Region::firstOrCreate(['name' => 'Châu Á & Úc'], ['sort' => 2]);

        $dongBacA = SubRegion::firstOrCreate(['name' => 'Đông Bắc Á', 'region_id' => $asia->id], ['sort' => 1]);
        $dongNamA = SubRegion::firstOrCreate(['name' => 'Đông Nam Á', 'region_id' => $asia->id], ['sort' => 2]);
        $chauDaiDuong = SubRegion::firstOrCreate(['name' => 'Châu Đại Dương', 'region_id' => $asia->id], ['sort' => 3]);
        $namA = SubRegion::firstOrCreate(['name' => 'Nam Á', 'region_id' => $asia->id], ['sort' => 4]);

        $asiaAirports = [
            ['sub_region_id' => $dongBacA->id, 'name' => 'Tokyo', 'code' => 'NRT', 'base_price' => 5500000],
            ['sub_region_id' => $dongBacA->id, 'name' => 'Seoul', 'code' => 'ICN', 'base_price' => 3200000],
            ['sub_region_id' => $dongBacA->id, 'name' => 'Đài Bắc', 'code' => 'TPE', 'base_price' => 4500000],
            ['sub_region_id' => $dongBacA->id, 'name' => 'Bắc Kinh', 'code' => 'PEK', 'base_price' => 4200000],
            ['sub_region_id' => $dongBacA->id, 'name' => 'Hồng Kông', 'code' => 'HKG', 'base_price' => 3800000],
            ['sub_region_id' => $dongNamA->id, 'name' => 'Bangkok', 'code' => 'BKK', 'base_price' => 2500000],
            ['sub_region_id' => $dongNamA->id, 'name' => 'Singapore', 'code' => 'SIN', 'base_price' => 3500000],
            ['sub_region_id' => $dongNamA->id, 'name' => 'Kuala Lumpur', 'code' => 'KUL', 'base_price' => 2800000],
            ['sub_region_id' => $dongNamA->id, 'name' => 'Manila', 'code' => 'MNL', 'base_price' => 3000000],
            ['sub_region_id' => $dongNamA->id, 'name' => 'Phnom Penh', 'code' => 'PNH', 'base_price' => 2200000],
            ['sub_region_id' => $chauDaiDuong->id, 'name' => 'Sydney', 'code' => 'SYD', 'base_price' => 9500000],
            ['sub_region_id' => $chauDaiDuong->id, 'name' => 'Melbourne', 'code' => 'MEL', 'base_price' => 9200000],
            ['sub_region_id' => $namA->id, 'name' => 'New Delhi', 'code' => 'DEL', 'base_price' => 5800000],
            ['sub_region_id' => $namA->id, 'name' => 'Mumbai', 'code' => 'BOM', 'base_price' => 5500000],
        ];
        foreach ($asiaAirports as $ap) {
            Airport::firstOrCreate(['code' => $ap['code']], $ap);
        }

        // ========== Châu Âu ==========
        $europe = Region::firstOrCreate(['name' => 'Châu Âu'], ['sort' => 3]);

        $tayAu = SubRegion::firstOrCreate(['name' => 'Tây Âu', 'region_id' => $europe->id], ['sort' => 1]);
        $dongAu = SubRegion::firstOrCreate(['name' => 'Đông Âu', 'region_id' => $europe->id], ['sort' => 2]);
        $bacAu = SubRegion::firstOrCreate(['name' => 'Bắc Âu', 'region_id' => $europe->id], ['sort' => 3]);

        $euroAirports = [
            ['sub_region_id' => $tayAu->id, 'name' => 'Paris', 'code' => 'CDG', 'base_price' => 12000000],
            ['sub_region_id' => $tayAu->id, 'name' => 'London', 'code' => 'LHR', 'base_price' => 13500000],
            ['sub_region_id' => $tayAu->id, 'name' => 'Frankfurt', 'code' => 'FRA', 'base_price' => 11000000],
            ['sub_region_id' => $tayAu->id, 'name' => 'Amsterdam', 'code' => 'AMS', 'base_price' => 11500000],
            ['sub_region_id' => $dongAu->id, 'name' => 'Moscow', 'code' => 'SVO', 'base_price' => 10000000],
            ['sub_region_id' => $dongAu->id, 'name' => 'Prague', 'code' => 'PRG', 'base_price' => 10500000],
            ['sub_region_id' => $dongAu->id, 'name' => 'Budapest', 'code' => 'BUD', 'base_price' => 10200000],
            ['sub_region_id' => $bacAu->id, 'name' => 'Stockholm', 'code' => 'ARN', 'base_price' => 12500000],
            ['sub_region_id' => $bacAu->id, 'name' => 'Helsinki', 'code' => 'HEL', 'base_price' => 12000000],
        ];
        foreach ($euroAirports as $ap) {
            Airport::firstOrCreate(['code' => $ap['code']], $ap);
        }

        // ========== Mỹ & Canada ==========
        $america = Region::firstOrCreate(['name' => 'Mỹ & Canada'], ['sort' => 4]);

        $bacMy = SubRegion::firstOrCreate(['name' => 'Bắc Mỹ', 'region_id' => $america->id], ['sort' => 1]);
        $namMy = SubRegion::firstOrCreate(['name' => 'Nam Mỹ', 'region_id' => $america->id], ['sort' => 2]);

        $usaAirports = [
            ['sub_region_id' => $bacMy->id, 'name' => 'New York', 'code' => 'JFK', 'base_price' => 18000000],
            ['sub_region_id' => $bacMy->id, 'name' => 'Los Angeles', 'code' => 'LAX', 'base_price' => 17500000],
            ['sub_region_id' => $bacMy->id, 'name' => 'San Francisco', 'code' => 'SFO', 'base_price' => 17000000],
            ['sub_region_id' => $bacMy->id, 'name' => 'Toronto', 'code' => 'YYZ', 'base_price' => 16000000],
            ['sub_region_id' => $bacMy->id, 'name' => 'Vancouver', 'code' => 'YVR', 'base_price' => 16500000],
            ['sub_region_id' => $namMy->id, 'name' => 'São Paulo', 'code' => 'GRU', 'base_price' => 20000000],
        ];
        foreach ($usaAirports as $ap) {
            Airport::firstOrCreate(['code' => $ap['code']], $ap);
        }

        // ========== Blog sample data ==========
        $blogs = [
            [
                'title' => 'Top 10 điểm đến hot nhất mùa hè 2026',
                'slug' => 'top-10-diem-den-hot-nhat-mua-he-2026',
                'category' => 'Cẩm nang',
                'excerpt' => 'Khám phá những điểm đến tuyệt vời nhất cho mùa hè năm nay, từ biển đảo trong nước đến các thành phố nổi tiếng châu Á.',
                'content' => '<p>Mùa hè 2026 đang đến gần, và đây là thời điểm tuyệt vời để lên kế hoạch cho chuyến du lịch. Dưới đây là top 10 điểm đến bạn không nên bỏ lỡ...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 8,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Hướng dẫn săn vé máy bay giá rẻ 2026',
                'slug' => 'huong-dan-san-ve-may-bay-gia-re-2026',
                'category' => 'Mẹo du lịch',
                'excerpt' => 'Bí quyết đặt vé máy bay với giá tốt nhất, tiết kiệm đến 50% chi phí di chuyển.',
                'content' => '<p>Bạn muốn bay giá rẻ? Hãy áp dụng những mẹo sau đây để luôn có được vé máy bay với giá tốt nhất...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 6,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Vietnam Airlines mở đường bay mới đến Frankfurt',
                'slug' => 'vietnam-airlines-mo-duong-bay-moi-den-frankfurt',
                'category' => 'Tin hàng không',
                'excerpt' => 'Vietnam Airlines chính thức khai trương đường bay thẳng Hà Nội - Frankfurt từ tháng 6/2026.',
                'content' => '<p>Vietnam Airlines vừa công bố khai trương đường bay thẳng Hà Nội - Frankfurt, Đức, bắt đầu từ ngày 15/06/2026...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 4,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Flash Sale: Giảm 40% vé bay nội địa tháng 4',
                'slug' => 'flash-sale-giam-40-ve-bay-noi-dia-thang-4',
                'category' => 'Khuyến mãi',
                'excerpt' => 'Chương trình khuyến mãi lớn nhất năm! Giảm đến 40% tất cả chặng bay nội địa Việt Nam.',
                'content' => '<p>Nhân dịp kỷ niệm ngày thành lập, giabaotravel triển khai chương trình khuyến mãi giảm đến 40% giá vé...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 3,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Cẩm nang du lịch Đà Nẵng từ A đến Z',
                'slug' => 'cam-nang-du-lich-da-nang-tu-a-den-z',
                'category' => 'Cẩm nang điểm đến',
                'excerpt' => 'Tất cả những gì bạn cần biết khi du lịch Đà Nẵng: ăn gì, ở đâu, chơi gì và đi lại thế nào.',
                'content' => '<p>Đà Nẵng là một trong những thành phố du lịch hàng đầu Việt Nam. Dưới đây là hướng dẫn chi tiết...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 12,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Lễ hội hoa anh đào Nhật Bản 2026 - Thời điểm và địa điểm',
                'slug' => 'le-hoi-hoa-anh-dao-nhat-ban-2026',
                'category' => 'Sự kiện',
                'excerpt' => 'Lịch trình chi tiết cho mùa hoa anh đào Nhật Bản 2026, kèm giá vé bay siêu rẻ.',
                'content' => '<p>Mùa hoa anh đào Nhật Bản là một trong những sự kiện được mong chờ nhất trong năm...</p>',
                'author' => 'Gia Bảo',
                'read_time' => 7,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
        ];
        foreach ($blogs as $b) {
            Blog::firstOrCreate(['slug' => $b['slug']], $b);
        }

        // ========== Flights sample data (SGN → HAN) ==========
        $flights = [
            ['airline_code' => 'VU', 'airline_name' => 'Vietravel Airlines', 'flight_number' => 'VU702', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '02:20', 'arrival_time' => '04:35', 'duration_minutes' => 135, 'aircraft_type' => '321', 'price' => 793240, 'day_of_week' => 0],
            ['airline_code' => 'VU', 'airline_name' => 'Vietravel Airlines', 'flight_number' => 'VU782', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '23:15', 'arrival_time' => '01:25', 'duration_minutes' => 130, 'aircraft_type' => '321', 'price' => 793240, 'day_of_week' => 0],
            ['airline_code' => '9G', 'airline_name' => '9G Airlines', 'flight_number' => '9G882', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '21:30', 'arrival_time' => '23:40', 'duration_minutes' => 130, 'aircraft_type' => '321', 'price' => 1007000, 'day_of_week' => 0],
            ['airline_code' => '9G', 'airline_name' => '9G Airlines', 'flight_number' => '9G886', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '22:30', 'arrival_time' => '00:40', 'duration_minutes' => 130, 'aircraft_type' => '32Q', 'price' => 1007000, 'day_of_week' => 0],
            ['airline_code' => '9G', 'airline_name' => '9G Airlines', 'flight_number' => '9G892', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '23:00', 'arrival_time' => '01:05', 'duration_minutes' => 125, 'aircraft_type' => '32Q', 'price' => 1007000, 'day_of_week' => 0],
            ['airline_code' => 'VU', 'airline_name' => 'Vietravel Airlines', 'flight_number' => 'VU750', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '05:45', 'arrival_time' => '07:55', 'duration_minutes' => 130, 'aircraft_type' => '321', 'price' => 1084840, 'day_of_week' => 0],
            ['airline_code' => 'VU', 'airline_name' => 'Vietravel Airlines', 'flight_number' => 'VU780', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'HAN', 'destination_name' => 'Hà Nội', 'departure_time' => '17:10', 'arrival_time' => '19:20', 'duration_minutes' => 130, 'aircraft_type' => '321', 'price' => 1084840, 'day_of_week' => 0],
            // HAN → SGN
            ['airline_code' => 'VN', 'airline_name' => 'Vietnam Airlines', 'flight_number' => 'VN201', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'SGN', 'destination_name' => 'Hồ Chí Minh', 'departure_time' => '06:00', 'arrival_time' => '08:10', 'duration_minutes' => 130, 'aircraft_type' => '321', 'price' => 1250000, 'day_of_week' => 0],
            ['airline_code' => 'VN', 'airline_name' => 'Vietnam Airlines', 'flight_number' => 'VN215', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'SGN', 'destination_name' => 'Hồ Chí Minh', 'departure_time' => '10:30', 'arrival_time' => '12:40', 'duration_minutes' => 130, 'aircraft_type' => '350', 'price' => 1450000, 'day_of_week' => 0],
            ['airline_code' => 'VJ', 'airline_name' => 'Vietjet Air', 'flight_number' => 'VJ133', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'SGN', 'destination_name' => 'Hồ Chí Minh', 'departure_time' => '07:15', 'arrival_time' => '09:30', 'duration_minutes' => 135, 'aircraft_type' => '320', 'price' => 890000, 'day_of_week' => 0],
            ['airline_code' => 'VJ', 'airline_name' => 'Vietjet Air', 'flight_number' => 'VJ145', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'SGN', 'destination_name' => 'Hồ Chí Minh', 'departure_time' => '14:00', 'arrival_time' => '16:15', 'duration_minutes' => 135, 'aircraft_type' => '321', 'price' => 980000, 'day_of_week' => 0],
            ['airline_code' => 'QH', 'airline_name' => 'Bamboo Airways', 'flight_number' => 'QH201', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'SGN', 'destination_name' => 'Hồ Chí Minh', 'departure_time' => '08:45', 'arrival_time' => '11:00', 'duration_minutes' => 135, 'aircraft_type' => '789', 'price' => 1350000, 'day_of_week' => 0],
            // HAN → DAD
            ['airline_code' => 'VN', 'airline_name' => 'Vietnam Airlines', 'flight_number' => 'VN161', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'DAD', 'destination_name' => 'Đà Nẵng', 'departure_time' => '06:30', 'arrival_time' => '07:50', 'duration_minutes' => 80, 'aircraft_type' => '321', 'price' => 950000, 'day_of_week' => 0],
            ['airline_code' => 'VJ', 'airline_name' => 'Vietjet Air', 'flight_number' => 'VJ523', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'DAD', 'destination_name' => 'Đà Nẵng', 'departure_time' => '09:00', 'arrival_time' => '10:15', 'duration_minutes' => 75, 'aircraft_type' => '320', 'price' => 690000, 'day_of_week' => 0],
            ['airline_code' => 'QH', 'airline_name' => 'Bamboo Airways', 'flight_number' => 'QH161', 'origin_code' => 'HAN', 'origin_name' => 'Hà Nội', 'destination_code' => 'DAD', 'destination_name' => 'Đà Nẵng', 'departure_time' => '12:30', 'arrival_time' => '13:50', 'duration_minutes' => 80, 'aircraft_type' => 'E90', 'price' => 1100000, 'day_of_week' => 0],
            // SGN → DAD
            ['airline_code' => 'VN', 'airline_name' => 'Vietnam Airlines', 'flight_number' => 'VN121', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'DAD', 'destination_name' => 'Đà Nẵng', 'departure_time' => '07:00', 'arrival_time' => '08:20', 'duration_minutes' => 80, 'aircraft_type' => '321', 'price' => 880000, 'day_of_week' => 0],
            ['airline_code' => 'VJ', 'airline_name' => 'Vietjet Air', 'flight_number' => 'VJ601', 'origin_code' => 'SGN', 'origin_name' => 'Hồ Chí Minh', 'destination_code' => 'DAD', 'destination_name' => 'Đà Nẵng', 'departure_time' => '11:00', 'arrival_time' => '12:15', 'duration_minutes' => 75, 'aircraft_type' => '320', 'price' => 750000, 'day_of_week' => 0],
        ];
        foreach ($flights as $fl) {
            Flight::firstOrCreate(['flight_number' => $fl['flight_number']], $fl);
        }

        $this->command->info('✅ Seeded: Airlines, Regions, SubRegions, Airports, Blogs, Flights & Admin user.');
    }
}
