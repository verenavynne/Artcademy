<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Course::with('courseLecturers.lecturer.user')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('Artcademy.home', compact('courses'));
    }
}
