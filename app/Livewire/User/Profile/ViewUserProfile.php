<?php

namespace App\Livewire\User\Profile;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ViewUserProfile extends Component
{
    public $userId;
    public $user;

    public function mount($id)
    {
        $this->userId = $id;
        $this->user = User::findOrFail($id);
    }


    public function render()
    {
        return view('livewire.user.profile.view-user-profile',[
            'user' => $this->user,
            'formattedDateOfBirth' => Carbon::parse($this->user->date_of_birth)->translatedFormat('d F Y'),
        ]);
    }
}
