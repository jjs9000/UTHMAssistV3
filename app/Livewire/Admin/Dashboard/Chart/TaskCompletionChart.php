<?php

namespace App\Livewire\Admin\Dashboard\Chart;

use App\Models\TaskPosting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TaskCompletionChart extends Component
{
    public $taskCompletionData;

    public function mount()
    {
        $this->taskCompletionData = $this->fetchTaskCompletionData();
    }

    public function fetchTaskCompletionData()
    {
        $data = TaskPosting::select(
            DB::raw('COUNT(id) as total'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        return $data;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.chart.task-completion-chart',[
            'taskCompletionData' => $this->taskCompletionData,
        ]);
    }
}
