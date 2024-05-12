<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Application;
use App\Models\Tag;
use App\Models\TaskPosting;

class AdminDashboard extends Component
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
        $totalFeedbackReviews = 100;

        return view('livewire.admin-dashboard', compact('totalUsers', 'totalApplications', 'totalTags', 'totalTaskPostings', 'totalFeedbackReviews'));
    }
}
