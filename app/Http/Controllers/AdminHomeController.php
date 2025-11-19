<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use App\Models\Event;

class AdminHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalCourses = Course::count();
        $totalUsers = User::count();
        $totalEvents = Event::count();

        $courses = Course::all();

        $hour = now()->timezone('Asia/Jakarta')->hour;
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Sore';
        } else {
            $greeting = 'Malam';
        }

        return view('admin.home', compact('user', 'greeting', 'totalCourses', 'totalUsers', 'totalEvents', 'courses'));

    }
}
