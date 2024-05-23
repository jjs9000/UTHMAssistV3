<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['profilePictureUpdated' => '$refresh'];

    public bool $showUserProfile;
    public bool $isModalOpen = false;

    public function mount()
    {
        $this->showUserProfile = Session::get('showUserProfile', true);
    }

    #[On('showUserProfile')]
    public function showUserProfile()
    {
        if (!$this->isModalOpen) {
            $this->showUserProfile = true;
            Session::put('showUserProfile', true);
        }
    }

    #[On('showUserTimetable')]
    public function showUserTimetable()
    {
        if (!$this->isModalOpen) {
            $this->showUserProfile = false;
            Session::put('showUserProfile', false);
            $this->resetPage();
        }
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
        return view('livewire.dashboard.index',[
            'showUserProfile' => $this->showUserProfile,
        ]);
    }
}
