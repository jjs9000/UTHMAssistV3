<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;
    
    protected $listeners = ['userDeleted' => '$refresh', 'showViewUserModal', 'openViewUserModal'];


    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $admin = '';
    
    #[Url(history:true)]
    public $gender = '';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 5;
    

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function openViewUserModal($userId)
    {
        $this->dispatch('openModal', 'view-user-modal', ['user' => $userId]);
        $this->dispatch('admin-user', 'modalOpened');
    }

    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
        }

        $this->sortBy = $sortByField;
    }

    public function getFormattedDateOfBirth($dateOfBirth)
    {
        return Carbon::parse($dateOfBirth)->format('d F Y');
    }
    
    public function render()
    {
        return view('livewire.user-table',[
            'users' => User::search($this->search)
            ->when($this->admin !== '', function($query){
                $query->where('usertype', $this->admin);
            })
            ->when($this->gender !== '', function($query){
                $query->where('gender', $this->gender);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage),
        ]);
    }
}
