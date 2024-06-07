<?php

namespace App\Livewire\User\Profile;

use App\Models\Feedback;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ViewUserProfile extends Component
{
    public $userId;
    public $user;
    public $feedbacks;
    public $averageRating;

    public function mount($id)
    {
        $this->userId = $id;
        $this->user = User::findOrFail($id);
        
        // Get the IDs of tasks posted by the user
        $taskIds = $this->user->taskPostings()->pluck('id');

        // Load feedbacks associated with tasks posted by the user
        $this->feedbacks = Feedback::whereIn('task_id', $taskIds)->get();

        // Calculate the total rating and count of feedbacks
        $totalRating = $this->feedbacks->sum('rating');
        $feedbackCount = $this->feedbacks->count();

        // Calculate the average rating (handle division by zero)
        $averageRating = $feedbackCount > 0 ? $totalRating / $feedbackCount : 0;

        // Format the average rating to one decimal place
        $this->averageRating = number_format($averageRating, 1);
    }


    public function render()
    {
        return view('livewire.user.profile.view-user-profile',[
            'user' => $this->user,
            'formattedDateOfBirth' => Carbon::parse($this->user->date_of_birth)->translatedFormat('d F Y'),
            'feedbacks' => $this->feedbacks,
        ]);
    }
}
