<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBox extends Component
{
    public $search = '';
    public $location = '';
    public $salaryMin = '';
    public $salaryMax = '';

    public function updatedSearch()
    {
        $this->dispatch('search', search : $this->search);
    }

    public function updatedLocation()
    {
        $this->dispatch('location', location : $this->location);
    }    

    public function render()
    {
        return view('livewire.search-box');
    }
}
