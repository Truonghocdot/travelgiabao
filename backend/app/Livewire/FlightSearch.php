<?php

namespace App\Livewire;

use App\Models\Flight;
use App\Models\Region;
use Carbon\Carbon;
use Livewire\Component;

class FlightSearch extends Component
{
    // Selected values
    public string $from = '';
    public string $fromCode = 'SGN';
    public string $fromName = 'Hồ Chí Minh';
    public string $to = '';
    public string $toCode = 'HAN';
    public string $toName = 'Hà Nội';
    public string $date = '';
    public string $returnDate = '';
    public string $passengers = '1 người lớn, Phổ thông';
    public string $tripType = 'roundtrip';

    // Airport/Location modals
    public bool $showFromModal = false;
    public bool $showToModal = false;
    public string $activeFromTab = '';
    public string $activeToTab = '';
    public string $searchQuery = '';

    // Passenger modal
    public bool $showPassengerModal = false;
    public int $adults = 1;
    public int $children = 0;
    public int $infants = 0;
    public string $seatClass = 'Phổ thông';

    // Date picker modals
    public bool $showDateModal = false;      // for departure
    public bool $showReturnModal = false;    // for return
    public int $calendarYear;
    public int $calendarMonth;
    public int $returnCalendarYear;
    public int $returnCalendarMonth;

    public function mount()
    {
        $this->date = now()->format('d/m/Y');
        $this->from = 'Hồ Chí Minh (SGN)';
        $this->to = 'Hà Nội (HAN)';

        $now = now();
        $this->calendarYear        = $now->year;
        $this->calendarMonth       = $now->month;
        $this->returnCalendarYear  = $now->year;
        $this->returnCalendarMonth = $now->month;

        $first = Region::orderBy('sort')->first();
        if ($first) {
            $this->activeFromTab = $first->name;
            $this->activeToTab   = $first->name;
        }
    }

    /* ── Airport modals ─────────────────────────── */
    public function openFromModal()
    {
        $this->searchQuery   = '';
        $this->showFromModal = true;
        $this->showToModal   = false;
        $this->showDateModal = false;
        $this->showReturnModal = false;
    }

    public function openToModal()
    {
        $this->searchQuery   = '';
        $this->showToModal   = true;
        $this->showFromModal = false;
        $this->showDateModal = false;
        $this->showReturnModal = false;
    }

    public function closeModals()
    {
        $this->showFromModal     = false;
        $this->showToModal       = false;
        $this->showPassengerModal = false;
        $this->showDateModal     = false;
        $this->showReturnModal   = false;
    }

    public function selectFrom(string $name, string $code)
    {
        $this->fromName      = $name;
        $this->fromCode      = $code;
        $this->from          = "{$name} ({$code})";
        $this->showFromModal = false;
        $this->searchQuery   = '';
    }

    public function selectTo(string $name, string $code)
    {
        $this->toName      = $name;
        $this->toCode      = $code;
        $this->to          = "{$name} ({$code})";
        $this->showToModal = false;
        $this->searchQuery = '';
    }

    public function swapLocations()
    {
        [$this->from, $this->to]         = [$this->to, $this->from];
        [$this->fromCode, $this->toCode] = [$this->toCode, $this->fromCode];
        [$this->fromName, $this->toName] = [$this->toName, $this->fromName];
    }

    public function setFromTab(string $name)
    {
        $this->activeFromTab = $name;
    }
    public function setToTab(string $name)
    {
        $this->activeToTab = $name;
    }

    /* ── Passenger modal ─────────────────────────── */
    public function togglePassengerModal()
    {
        $this->showPassengerModal = !$this->showPassengerModal;
        $this->showFromModal      = false;
        $this->showToModal        = false;
        $this->showDateModal      = false;
        $this->showReturnModal    = false;
    }

    public function updatePassengers()
    {
        $parts = [];
        if ($this->adults   > 0) $parts[] = "{$this->adults} người lớn";
        if ($this->children > 0) $parts[] = "{$this->children} trẻ em";
        if ($this->infants  > 0) $parts[] = "{$this->infants} em bé";
        $this->passengers         = implode(', ', $parts) . ', ' . $this->seatClass;
        $this->showPassengerModal = false;
    }

    public function incrementAdults()
    {
        if ($this->adults   < 9) $this->adults++;
    }
    public function decrementAdults()
    {
        if ($this->adults   > 1) $this->adults--;
    }
    public function incrementChildren()
    {
        if ($this->children < 9) $this->children++;
    }
    public function decrementChildren()
    {
        if ($this->children > 0) $this->children--;
    }
    public function incrementInfants()
    {
        if ($this->infants  < 9) $this->infants++;
    }
    public function decrementInfants()
    {
        if ($this->infants  > 0) $this->infants--;
    }

    /* ── Date picker modals ─────────────────────── */
    public function openDateModal()
    {
        $this->showDateModal      = true;
        $this->showReturnModal    = false;
        $this->showFromModal      = false;
        $this->showToModal        = false;
        $this->showPassengerModal = false;
    }

    public function openReturnModal()
    {
        $this->showReturnModal    = true;
        $this->showDateModal      = false;
        $this->showFromModal      = false;
        $this->showToModal        = false;
        $this->showPassengerModal = false;
    }

    public function prevCalendarMonth()
    {
        $d = Carbon::create($this->calendarYear, $this->calendarMonth, 1)->subMonth();
        $this->calendarYear  = $d->year;
        $this->calendarMonth = $d->month;
    }

    public function nextCalendarMonth()
    {
        $d = Carbon::create($this->calendarYear, $this->calendarMonth, 1)->addMonth();
        $this->calendarYear  = $d->year;
        $this->calendarMonth = $d->month;
    }

    public function prevReturnMonth()
    {
        $d = Carbon::create($this->returnCalendarYear, $this->returnCalendarMonth, 1)->subMonth();
        $this->returnCalendarYear  = $d->year;
        $this->returnCalendarMonth = $d->month;
    }

    public function nextReturnMonth()
    {
        $d = Carbon::create($this->returnCalendarYear, $this->returnCalendarMonth, 1)->addMonth();
        $this->returnCalendarYear  = $d->year;
        $this->returnCalendarMonth = $d->month;
    }

    public function selectDate(string $date)
    {
        $this->date          = $date;
        $this->showDateModal = false;
    }

    public function selectReturnDate(string $date)
    {
        $this->returnDate       = $date;
        $this->showReturnModal  = false;
    }

    /* ── Render ─────────────────────────────────── */
    public function render()
    {
        $regions = Region::with('subRegions.airports')->orderBy('sort')->get();

        // Filter airports by search query
        $filtered = null;
        if ($this->searchQuery && strlen($this->searchQuery) > 0) {
            $q        = mb_strtolower($this->searchQuery);
            $filtered = collect();
            foreach ($regions as $region) {
                foreach ($region->subRegions as $sub) {
                    foreach ($sub->airports as $ap) {
                        if (
                            str_contains(mb_strtolower($ap->name), $q) ||
                            str_contains(mb_strtolower($ap->code), $q)
                        ) {
                            $filtered->push($ap);
                        }
                    }
                }
            }
        }

        // Build price-per-day-of-week map for departure calendar
        // day_of_week: 0=Sun … 6=Sat (Carbon convention)
        $priceDow = Flight::where('origin_code', $this->fromCode)
            ->where('destination_code', $this->toCode)
            ->where('is_active', true)
            ->selectRaw('day_of_week, MIN(price) as min_price')
            ->groupBy('day_of_week')
            ->pluck('min_price', 'day_of_week')
            ->toArray();

        // Build calendar days for departure
        $calStart      = Carbon::create($this->calendarYear, $this->calendarMonth, 1);
        $calendarDays  = $this->buildCalendarDays($calStart, $priceDow);

        // Build calendar days for return
        $retStart      = Carbon::create($this->returnCalendarYear, $this->returnCalendarMonth, 1);
        $returnDays    = $this->buildCalendarDays($retStart, $priceDow);

        return view('livewire.flight-search', compact(
            'regions',
            'filtered',
            'priceDow',
            'calendarDays',
            'returnDays'
        ));
    }

    private function buildCalendarDays(Carbon $monthStart, array $priceDow): array
    {
        $days  = [];
        $today = Carbon::today();

        // Pad leading empty days (Mon=0 … Sun=6 in our grid)
        $startDow = $monthStart->dayOfWeek; // 0=Sun
        // Convert to Mon-first
        $padCount = ($startDow + 6) % 7;
        for ($i = 0; $i < $padCount; $i++) {
            $days[] = null;
        }

        $daysInMonth = $monthStart->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date  = $monthStart->copy()->setDay($day);
            $dow   = $date->dayOfWeek;           // 0=Sun … 6=Sat
            $price = $priceDow[$dow] ?? null;

            $days[] = [
                'date'     => $date->format('d/m/Y'),
                'day'      => $day,
                'price'    => $price,
                'past'     => $date->lt($today),
                'today'    => $date->isToday(),
                'dow'      => $dow,
            ];
        }

        return $days;
    }
}
