<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $regions = Region::with('subRegions.airports')->orderBy('sort')->get();
        $latestBlogs = Blog::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();

        // Ưu đãi hot: airports có min_price, lấy 6 rẻ nhất
        $hotDeals = \App\Models\Airport::whereNotNull('min_price')
            ->where('min_price', '>', 0)
            ->orderBy('min_price')
            ->take(6)
            ->get();

        // Điểm đến phổ biến: airports Việt Nam, lấy 5 có base_price
        $vnRegion = Region::where('name', 'Việt Nam')->first();
        $popularRoutes = \App\Models\Airport::whereHas('subRegion', function ($q) use ($vnRegion) {
            $q->where('region_id', $vnRegion?->id);
        })
            ->whereNotNull('base_price')
            ->orderBy('base_price')
            ->take(5)
            ->get();

        return view('pages.home', compact('regions', 'latestBlogs', 'hotDeals', 'popularRoutes'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function tinTuc(Request $request)
    {
        $query = Blog::where('is_published', true);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(9);
        $featured = Blog::where('is_published', true)->where('is_featured', true)->orderBy('published_at', 'desc')->first();

        return view('pages.tin-tuc', compact('blogs', 'featured'));
    }

    public function blogDetail(string $slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedBlogs = Blog::where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.blog-detail', compact('blog', 'relatedBlogs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function schedule(Request $request)
    {
        $from = $request->query('from', 'Hồ Chí Minh (SGN)');
        $to = $request->query('to', 'Hà Nội (HAN)');
        $date = $request->query('date', now()->format('d/m/Y'));
        $passengers = $request->query('passengers', '1 người lớn, Phổ thông');

        $originCode = $this->extractCode($from);
        $destCode = $this->extractCode($to);

        $today = Carbon::today();
        $selectedDate = $request->query('selected_date', $today->format('Y-m-d'));
        $dates = [];
        $dayNames = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];

        for ($i = 0; $i < 7; $i++) {
            $d = $today->copy()->addDays($i);
            $dates[] = [
                'value' => $d->format('Y-m-d'),
                'dayName' => $dayNames[$d->dayOfWeek],
                'dayMonth' => $d->format('d/m'),
            ];
        }

        $query = Flight::where('is_active', true);
        if ($originCode) {
            $query->where('origin_code', $originCode);
        }
        if ($destCode) {
            $query->where('destination_code', $destCode);
        }
        $flights = $query->orderBy('departure_time')->get();

        session(['search' => compact('from', 'to', 'date', 'passengers', 'selectedDate')]);

        return view('pages.schedule', compact(
            'from',
            'to',
            'date',
            'passengers',
            'dates',
            'selectedDate',
            'flights'
        ));
    }

    public function booking(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_note' => 'nullable|string|max:1000',
            'passengers' => 'nullable|integer|min:1|max:10',
            'flight_number' => 'required|string',
            'airline_name' => 'required|string',
            'origin' => 'nullable|string',
            'destination' => 'nullable|string',
            'departure_time' => 'nullable|string',
            'arrival_time' => 'nullable|string',
            'flight_date' => 'nullable|string',
            'price' => 'nullable|integer',
        ]);

        $validated['booking_code'] = Booking::generateBookingCode();
        $validated['status'] = 'pending';

        Booking::create($validated);

        $search = session('search', []);
        $query = http_build_query([
            'from' => $search['from'] ?? '',
            'to' => $search['to'] ?? '',
            'date' => $search['date'] ?? '',
            'passengers' => $search['passengers'] ?? '',
            'selected_date' => $validated['flight_date'] ?? '',
        ]);

        return redirect("/schedule?{$query}")
            ->with('booking_success', true)
            ->with('booking_code', $validated['booking_code']);
    }

    private function extractCode(string $input): ?string
    {
        if (preg_match('/\(([A-Z]{3})\)/', $input, $m)) {
            return $m[1];
        }
        if (preg_match('/^[A-Z]{3}$/', trim($input))) {
            return trim($input);
        }
        return null;
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:30',
            'customer_email' => 'nullable|email|max:255',
            'customer_note'  => 'required|string',
        ]);

        Booking::create([
            'booking_code'   => Booking::generateBookingCode(),
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_note'  => $request->customer_note,
            'status'         => 'pending',
            // Placeholders – staff will fill in flight info from admin
            'flight_number'  => null,
            'airline_name'   => 'Liên hệ',
            'origin'         => null,
            'destination'    => null,
            'departure_time' => null,
            'arrival_time'   => null,
            'flight_date'    => now()->toDateString(),
            'price'          => 0,
            'passengers'     => '1 người lớn',
        ]);

        return redirect()->route('contact')
            ->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }
}
