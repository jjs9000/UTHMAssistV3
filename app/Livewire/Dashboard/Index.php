<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['profilePictureUpdated' => '$refresh', 'showUserProfile', 'showUserTask', 'showUserTimetable'];

    public bool $showUserProfile;
    public bool $showUserTask = false;
    public bool $showUserTimetable = false;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showUserProfile = Session::get('showUserProfile', true);
        $this->showUserTask = Session::get('showUserTask', false);
        $this->showUserTimetable = Session::get('showUserTimetable', false);
    }

    #[On('showUserProfile')]
    public function showUserProfile()
    {
        if (!$this->isModalOpen) {
            $this->resetTabs();
            $this->showUserProfile = true;
            Session::put('showUserProfile', true);
            Session::put('showUserTask', false);
            Session::put('showUserTimetable', false);
        }
    }

    #[On('showUserTask')]
    public function showUserTask()
    {
        if (!$this->isModalOpen) {
            $this->resetTabs();
            $this->showUserTask = true;
            Session::put('showUserProfile', false);
            Session::put('showUserTask', true);
            Session::put('showUserTimetable', false);
            $this->resetPage();
        }
    }

    #[On('showUserTimetable')]
    public function showUserTimetable()
    {
        if (!$this->isModalOpen) {
            $this->resetTabs();
            $this->showUserTimetable = true;
            Session::put('showUserProfile', false);
            Session::put('showUserTask', false);
            Session::put('showUserTimetable', true);
            $this->resetPage();
        }
    }

    private function resetTabs()
    {
        $this->showUserProfile = false;
        $this->showUserTask = false;
        $this->showUserTimetable = false;
    }

    public function handleModalClosed()
    {
        $this->isModalOpen = false;
    }

    public function handleModalOpened()
    {
        $this->isModalOpen = true;
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'showUserProfile' => $this->showUserProfile,
            'showUserTask' => $this->showUserTask,
            'showUserTimetable' => $this->showUserTimetable,
        ]);
    }
}