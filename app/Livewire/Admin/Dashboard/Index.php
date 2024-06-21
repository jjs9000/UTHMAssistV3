<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Application;
use App\Models\Feedback;
use App\Models\Tag;
use App\Models\TaskPosting;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Count total users
        $totalUsers = User::count();

        // Count total applications
        $totalApplications = Application::count();

        // Count total tags
        $totalTags = Tag::count();

        // Count total task postings
        $totalTaskPostings = TaskPosting::count();

        // Hardcoded value for total feedback & reviews (replace with actual logic)
        $totalFeedbackReviews = Feedback::count();

        return view('livewire.admin.dashboard.index',[
            'totalUsers' => $totalUsers,
            'totalApplications' => $totalApplications,
            'totalTags' => $totalTags,
            'totalTaskPostings' => $totalTaskPostings,
            'totalFeedbackReviews' => $totalFeedbackReviews
        ]);
    }
}
