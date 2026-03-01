<?php

namespace App\Livewire;

use App\Models\Region;
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

    // Modal state
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

    public function mount()
    {
        $this->date = now()->format('d/m/Y');
        $this->from = 'Hồ Chí Minh (SGN)';
        $this->to = 'Hà Nội (HAN)';
        // Default first region name
        $first = Region::orderBy('sort')->first();
        if ($first) {
            $this->activeFromTab = $first->name;
            $this->activeToTab = $first->name;
        }
    }

    public function openFromModal()
    {
        $this->searchQuery = '';
        $this->showFromModal = true;
        $this->showToModal = false;
    }

    public function openToModal()
    {
        $this->searchQuery = '';
        $this->showToModal = true;
        $this->showFromModal = false;
    }

    public function closeModals()
    {
        $this->showFromModal = false;
        $this->showToModal = false;
        $this->showPassengerModal = false;
    }

    public function selectFrom(string $name, string $code)
    {
        $this->fromName = $name;
        $this->fromCode = $code;
        $this->from = "{$name} ({$code})";
        $this->showFromModal = false;
        $this->searchQuery = '';
    }

    public function selectTo(string $name, string $code)
    {
        $this->toName = $name;
        $this->toCode = $code;
        $this->to = "{$name} ({$code})";
        $this->showToModal = false;
        $this->searchQuery = '';
    }

    public function swapLocations()
    {
        [$this->from, $this->to] = [$this->to, $this->from];
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

    public function togglePassengerModal()
    {
        $this->showPassengerModal = !$this->showPassengerModal;
        $this->showFromModal = false;
        $this->showToModal = false;
    }

    public function updatePassengers()
    {
        $parts = [];
        if ($this->adults > 0) $parts[] = "{$this->adults} người lớn";
        if ($this->children > 0) $parts[] = "{$this->children} trẻ em";
        if ($this->infants > 0) $parts[] = "{$this->infants} em bé";
        $this->passengers = implode(', ', $parts) . ', ' . $this->seatClass;
        $this->showPassengerModal = false;
    }

    public function incrementAdults()
    {
        if ($this->adults < 9) $this->adults++;
    }
    public function decrementAdults()
    {
        if ($this->adults > 1) $this->adults--;
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
        if ($this->infants < 9) $this->infants++;
    }
    public function decrementInfants()
    {
        if ($this->infants > 0) $this->infants--;
    }

    public function render()
    {
        $regions = Region::with('subRegions.airports')->orderBy('sort')->get();

        // Filter airports by search query
        $filtered = null;
        if ($this->searchQuery && strlen($this->searchQuery) > 0) {
            $q = mb_strtolower($this->searchQuery);
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

        return view('livewire.flight-search', compact('regions', 'filtered'));
    }
}
