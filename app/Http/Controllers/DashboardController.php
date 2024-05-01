<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskPosting;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve tasks posted by the user
        $postedTasks = TaskPosting::where('user_id', $user->id)->get();

        // Retrieve applications for the user's tasks
        $applications = Application::whereIn('task_id', $postedTasks->pluck('id'))->get();

        // Retrieve applications made by the user
        $userApplications = $user->applications;

        // dd($userApplications->task[0]->title);

        return view('dashboard', [
            'user' => $user,
            'postedTasks' => $postedTasks,
            'applications' => $applications,
            'userApplications' => $userApplications,
        ]);
    }
}
