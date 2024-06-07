<?php

namespace App\Livewire\Admin\Dashboard\Chart;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserGrowthChart extends Component
{
    public $userGrowthData;

    public function mount()
    {
        $this->userGrowthData = $this->fetchUserGrowthData();
    }

    public function fetchUserGrowthData()
    {
        // Query to fetch user demographics data
        $data = User::select(
            DB::raw('COUNT(id) as count'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('gender'),
            DB::raw('date_of_birth')
        )
            ->groupBy('month', 'year', 'gender', 'date_of_birth')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        
        // Format the date of birth
        $data->transform(function ($item) {
            $item->date_of_birth = date('F Y', strtotime($item->date_of_birth)); // Convert to full month name and year
            return $item;
        });

        return $data;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.chart.user-growth-chart');
    }
}
